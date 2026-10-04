import { NextRequest, NextResponse } from "next/server";
import { prisma } from "@/lib/prisma";
import { guardApi } from "@/lib/guards";

type RouteContext = {
  params: Promise<{
    id: string;
  }>;
};

export async function GET(request: NextRequest, context: RouteContext) {
  try {
    const { error } = await guardApi("tutor");
    if (error) return error;
    const { id } = await context.params;
    const tutorId = Number(id);

    if (!Number.isInteger(tutorId) || tutorId <= 0) {
      return NextResponse.json(
        { message: "Identifiant du tuteur invalide." },
        { status: 400 },
      );
    }

    const tutor = await prisma.tutor.findUnique({
      where: {
        userId: tutorId,
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
        { message: "Tuteur introuvable." },
        { status: 404 },
      );
    }

    const averageRating =
      tutor.reviews.length > 0
        ? tutor.reviews.reduce((total, review) => total + review.rating, 0) /
          tutor.reviews.length
        : null;

        const tutorData = {
          name: `${tutor.user.firstName} ${tutor.user.lastName}`,
          gender: tutor.user.gender,
          createdAt: tutor.user.createdAt,
          bio: tutor.bio,
          photo: tutor.photo,
          locationMap: tutor.locationMap,
          city: tutor.city,
          district: tutor.district,
          availability: tutor.availability,
          isVerified: tutor.isVerified,
          verifiedAt: tutor.verifiedAt,
          averageRating:averageRating === null ? null : Number(averageRating.toFixed(1)),
          reviewsCount: tutor.reviews.length,
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
        };

    return NextResponse.json( { tutor: tutorData},{ status: 200 },);
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
