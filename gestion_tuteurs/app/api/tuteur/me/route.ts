import { NextResponse } from "next/server";
import { prisma } from "@/lib/prisma";
import { guardApi } from "@/lib/guards";

export async function GET() {
  try {
    const garde = await guardApi("tutor");

    if ("error" in garde) return garde.error;

    const userId = Number(garde.session.user?.id);
    if (!Number.isInteger(userId) || userId <= 0) {
      return NextResponse.json(
        { message: "Session invalide." },
        { status: 401 },
      );
    }

    const tutor = await prisma.tutor.findUnique({
      where: {
        userId,
      },

      select: {
        userId: true,
        bio: true,
        photo: true,
        locationMap: true,
        city: true,
        district: true,
        availability: true,
        isVerified: true,
        verifiedAt: true,

        user: {
          select: {
            firstName: true,
            lastName: true,
            gender: true,
            createdAt: true,
            email: true,
            phone: true,
            whatsapp: true,
          },
        },

        assignments: {
          select: {
            id: true,

            subject: {
              select: {
                id: true,
                name: true,
              },
            },

            level: {
              select: {
                id: true,
                name: true,
                cycle: true,
              },
            },
          },
        },
        applications: {
          orderBy: {
            createdAt: "desc",
          },

          select: {
            id: true,
            status: true,
            createdAt: true,
      
            request: {
              select: {
                id: true,
                status: true,
                createdAt: true,
                offeredAmount: true,
                preferredDays: true,
                preferredTime: true,
                durationMin: true,
                preferredGender: true,
                preferredPlace  : true,
                student: {
                  select: {
                    id: true,
                    firstName: true,
                    lastName: true,
                  },
                },
                level: {
                  select: {
                    id: true,
                    name: true,
                  },
                },
                subject: {
                  select: {
                    id: true,
                    name: true,
                  },
                },
              },
            },
          },
        },

        reviews: {
          orderBy: {
            createdAt: "desc",
          },

          select: {
            id: true,
            rating: true,
            comment: true,
            createdAt: true,

            author: {
              select: {
                firstName: true,
                lastName: true,
              },
            },
          },
        },
      },
    });

    if (!tutor) {
      return NextResponse.json(
        { message: "Aucune fiche tuteur pour ce compte." },
        { status: 404 },
      );
    }

    const encaisse = await prisma.payment.aggregate({
      where: { status: "PAID", contract: { tutorId: userId } },
      _sum: { amount: true },
    });
    const revenus = Number(encaisse._sum.amount ?? 0);

    const averageRating =
      tutor.reviews.length > 0
        ? tutor.reviews.reduce((total, review) => total + review.rating, 0) /
          tutor.reviews.length
        : null;

    const tutorData = {
      userId: tutor.userId,
      firstName: tutor.user.firstName,
      lastName: tutor.user.lastName,
      gender: tutor.user.gender,
      createdAt: tutor.user.createdAt,
      email: tutor.user.email,
      phone: tutor.user.phone,
      whatsapp: tutor.user.whatsapp,
      bio: tutor.bio,
      photo: tutor.photo,
      locationMap: tutor.locationMap,
      city: tutor.city,
      applications: tutor.applications.map((application) => ({
        id: application.id,
        status: application.status,
        createdAt: application.createdAt,
      })),
      district: tutor.district,
      availability: tutor.availability,
      isVerified: tutor.isVerified,
      verifiedAt: tutor.verifiedAt,
      averageRating:
        averageRating === null ? null : Number(averageRating.toFixed(1)),
      reviewsCount: tutor.reviews.length,
      revenus,
      assignments: tutor.assignments.map((assignment) => ({
        id: assignment.id,
        subject: {
          id: assignment.subject.id,
          name: assignment.subject.name,
        },
        level: {
          id: assignment.level.id,
          name: assignment.level.name,
          cycle: assignment.level.cycle,
        },
      })),
      request: tutor.applications.map((application) => ({
        id: application.request.id,
        applicationId: application.id,
        applicationStatus: application.status,
        status: application.request.status,
        createdAt: application.request.createdAt,
        montantOffert: Number(application.request.offeredAmount),
        subject: application.request.subject.name,
        day: application.request.preferredDays,
        time: application.request.preferredTime,
        place: application.request.preferredPlace,
        duration: application.request.durationMin,
        gender: application.request.preferredGender,
        student: {
          id: application.request.student.id,
          firstName: application.request.student.firstName,
          lastName: application.request.student.lastName,
          level: {
            id: application.request.level.id,
            name: application.request.level.name,
          },
        },
      })),

    };

    return NextResponse.json({ tutorData }, { status: 200 });
  } catch (error) {
    console.error("Erreur lors de la récupération du tuteur :", error);

    return NextResponse.json(
      {
        message: "Une erreur est survenue pendant la récupération du tuteur.",
      },
      { status: 500 },
    );
  }
}
