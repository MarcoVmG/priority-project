"use client";

import Link from "next/link";

export default function Dashboard() {
  return (
    <>
      <div className="flex min-h-full flex-1 flex-col justify-center px-10 py-12 lg:px-8 ">
        <div className="sm:mx-auto sm:w-full sm:max-w-sm bg-neutral-300 rounded-md">
          <h2 className="mt-5 text-center text-2xl/9 font-bold tracking-tight text-zinc-800">
            Sign in to your account
          </h2>
          <p className="mt-2 text-center text-xl/9 font-regular tracking-tight text-zinc-800">
            Please fill up the form
          </p>
          <div className="flex grid grid-cols-3 gap-4 mx-5 my-5">
            <Link
              href="/user/userData"
              type="submit"
              className="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            >
              Personal Data
            </Link>
            <Link
              href="/user/medData"
              type="submit"
              className="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            >
              Medical Data
            </Link>
            <Link
              href="/user/emContact"
              type="submit"
              className="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            >
              Emergency Contact
            </Link>
          </div>
          <Link
            href="/"
            className="flex w-full justify-center  px-3 py-1.5 text-sm/6 font-semibold text-zinc-800 shadow-sm hover:text-lg/6"
          >
            Sign Out
          </Link>
        </div>
      </div>
    </>
  );
}
