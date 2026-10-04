-- CreateEnum
CREATE TYPE "Role" AS ENUM ('STUDENT', 'TUTOR', 'ADMIN');

-- CreateEnum
CREATE TYPE "RequestStatus" AS ENUM ('OPEN', 'FULFILLED', 'CANCELLED');

-- CreateEnum
CREATE TYPE "TutorApplicationStatus" AS ENUM ('PENDING', 'ACCEPTED', 'DECLINED');

-- CreateEnum
CREATE TYPE "PaymentStatus" AS ENUM ('DUE', 'PAID', 'CANCELLED');

-- CreateTable
CREATE TABLE "users" (
    "id" SERIAL NOT NULL,
    "email" TEXT NOT NULL,
    "passwordHash" TEXT NOT NULL,
    "role" "Role" NOT NULL DEFAULT 'STUDENT',
    "lastName" TEXT NOT NULL,
    "firstName" TEXT NOT NULL,
    "gender" TEXT,
    "phone" TEXT,
    "whatsapp" TEXT,
    "isActive" BOOLEAN NOT NULL DEFAULT true,
    "createdAt" TIMESTAMP(3) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    "updatedAt" TIMESTAMP(3) NOT NULL,

    CONSTRAINT "users_pkey" PRIMARY KEY ("id")
);

-- CreateTable
CREATE TABLE "tutors" (
    "userId" INTEGER NOT NULL,
    "bio" TEXT,
    "photo" TEXT,
    "locationMap" TEXT,
    "city" TEXT,
    "district" TEXT,
    "availability" TEXT,
    "isVerified" BOOLEAN NOT NULL DEFAULT false,
    "verifiedAt" TIMESTAMP(3),

    CONSTRAINT "tutors_pkey" PRIMARY KEY ("userId")
);

-- CreateTable
CREATE TABLE "students" (
    "userId" INTEGER NOT NULL,
    "levelId" INTEGER,
    "school" TEXT,

    CONSTRAINT "students_pkey" PRIMARY KEY ("userId")
);

-- CreateTable
CREATE TABLE "levels" (
    "id" SERIAL NOT NULL,
    "name" TEXT NOT NULL,
    "cycle" TEXT,
    "sortOrder" INTEGER NOT NULL DEFAULT 0,

    CONSTRAINT "levels_pkey" PRIMARY KEY ("id")
);

-- CreateTable
CREATE TABLE "subjects" (
    "id" SERIAL NOT NULL,
    "name" TEXT NOT NULL,

    CONSTRAINT "subjects_pkey" PRIMARY KEY ("id")
);

-- CreateTable
CREATE TABLE "teaching_assignments" (
    "id" SERIAL NOT NULL,
    "tutorId" INTEGER NOT NULL,
    "subjectId" INTEGER NOT NULL,
    "levelId" INTEGER NOT NULL,

    CONSTRAINT "teaching_assignments_pkey" PRIMARY KEY ("id")
);

-- CreateTable
CREATE TABLE "requests" (
    "id" SERIAL NOT NULL,
    "studentId" INTEGER NOT NULL,
    "levelId" INTEGER NOT NULL,
    "subjectId" INTEGER NOT NULL,
    "preferredGender" TEXT,
    "preferredPlace" TEXT,
    "preferredDays" TEXT,
    "preferredTime" TEXT,
    "durationMin" INTEGER,
    "offeredAmount" DECIMAL(10,2) NOT NULL,
    "status" "RequestStatus" NOT NULL DEFAULT 'OPEN',
    "createdAt" TIMESTAMP(3) NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT "requests_pkey" PRIMARY KEY ("id")
);

-- CreateTable
CREATE TABLE "applications" (
    "id" SERIAL NOT NULL,
    "requestId" INTEGER NOT NULL,
    "tutorId" INTEGER NOT NULL,
    "status" "TutorApplicationStatus" NOT NULL DEFAULT 'PENDING',
    "createdAt" TIMESTAMP(3) NOT NULL DEFAULT CURRENT_TIMESTAMP,
    "reviewedAt" TIMESTAMP(3),

    CONSTRAINT "applications_pkey" PRIMARY KEY ("id")
);

-- CreateTable
CREATE TABLE "contracts" (
    "id" SERIAL NOT NULL,
    "applicationId" INTEGER NOT NULL,
    "tutorId" INTEGER NOT NULL,
    "reference" TEXT NOT NULL,
    "amount" DECIMAL(10,2) NOT NULL,
    "startDate" DATE NOT NULL,
    "endDate" DATE,
    "plannedLessons" INTEGER,
    "signedAt" TIMESTAMP(3),

    CONSTRAINT "contracts_pkey" PRIMARY KEY ("id")
);

-- CreateTable
CREATE TABLE "payments" (
    "id" SERIAL NOT NULL,
    "contractId" INTEGER NOT NULL,
    "amount" DECIMAL(10,2) NOT NULL,
    "status" "PaymentStatus" NOT NULL DEFAULT 'DUE',
    "method" TEXT,
    "paidAt" TIMESTAMP(3),

    CONSTRAINT "payments_pkey" PRIMARY KEY ("id")
);

-- CreateTable
CREATE TABLE "reviews" (
    "id" SERIAL NOT NULL,
    "tutorId" INTEGER NOT NULL,
    "authorId" INTEGER NOT NULL,
    "rating" INTEGER NOT NULL,
    "comment" TEXT,
    "createdAt" TIMESTAMP(3) NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT "reviews_pkey" PRIMARY KEY ("id")
);

-- CreateIndex
CREATE UNIQUE INDEX "users_email_key" ON "users"("email");

-- CreateIndex
CREATE UNIQUE INDEX "levels_name_key" ON "levels"("name");

-- CreateIndex
CREATE UNIQUE INDEX "subjects_name_key" ON "subjects"("name");

-- CreateIndex
CREATE UNIQUE INDEX "teaching_assignments_tutorId_subjectId_levelId_key" ON "teaching_assignments"("tutorId", "subjectId", "levelId");

-- CreateIndex
CREATE INDEX "requests_status_createdAt_idx" ON "requests"("status", "createdAt");

-- CreateIndex
CREATE INDEX "applications_tutorId_status_idx" ON "applications"("tutorId", "status");

-- CreateIndex
CREATE UNIQUE INDEX "applications_requestId_tutorId_key" ON "applications"("requestId", "tutorId");

-- CreateIndex
CREATE UNIQUE INDEX "contracts_applicationId_key" ON "contracts"("applicationId");

-- CreateIndex
CREATE UNIQUE INDEX "contracts_reference_key" ON "contracts"("reference");

-- CreateIndex
CREATE UNIQUE INDEX "reviews_tutorId_authorId_key" ON "reviews"("tutorId", "authorId");

-- AddForeignKey
ALTER TABLE "tutors" ADD CONSTRAINT "tutors_userId_fkey" FOREIGN KEY ("userId") REFERENCES "users"("id") ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE "students" ADD CONSTRAINT "students_userId_fkey" FOREIGN KEY ("userId") REFERENCES "users"("id") ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE "students" ADD CONSTRAINT "students_levelId_fkey" FOREIGN KEY ("levelId") REFERENCES "levels"("id") ON DELETE SET NULL ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE "teaching_assignments" ADD CONSTRAINT "teaching_assignments_tutorId_fkey" FOREIGN KEY ("tutorId") REFERENCES "tutors"("userId") ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE "teaching_assignments" ADD CONSTRAINT "teaching_assignments_subjectId_fkey" FOREIGN KEY ("subjectId") REFERENCES "subjects"("id") ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE "teaching_assignments" ADD CONSTRAINT "teaching_assignments_levelId_fkey" FOREIGN KEY ("levelId") REFERENCES "levels"("id") ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE "requests" ADD CONSTRAINT "requests_studentId_fkey" FOREIGN KEY ("studentId") REFERENCES "users"("id") ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE "requests" ADD CONSTRAINT "requests_levelId_fkey" FOREIGN KEY ("levelId") REFERENCES "levels"("id") ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE "requests" ADD CONSTRAINT "requests_subjectId_fkey" FOREIGN KEY ("subjectId") REFERENCES "subjects"("id") ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE "applications" ADD CONSTRAINT "applications_requestId_fkey" FOREIGN KEY ("requestId") REFERENCES "requests"("id") ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE "applications" ADD CONSTRAINT "applications_tutorId_fkey" FOREIGN KEY ("tutorId") REFERENCES "tutors"("userId") ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE "contracts" ADD CONSTRAINT "contracts_applicationId_fkey" FOREIGN KEY ("applicationId") REFERENCES "applications"("id") ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE "contracts" ADD CONSTRAINT "contracts_tutorId_fkey" FOREIGN KEY ("tutorId") REFERENCES "tutors"("userId") ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE "payments" ADD CONSTRAINT "payments_contractId_fkey" FOREIGN KEY ("contractId") REFERENCES "contracts"("id") ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE "reviews" ADD CONSTRAINT "reviews_tutorId_fkey" FOREIGN KEY ("tutorId") REFERENCES "tutors"("userId") ON DELETE RESTRICT ON UPDATE CASCADE;

-- AddForeignKey
ALTER TABLE "reviews" ADD CONSTRAINT "reviews_authorId_fkey" FOREIGN KEY ("authorId") REFERENCES "users"("id") ON DELETE RESTRICT ON UPDATE CASCADE;
