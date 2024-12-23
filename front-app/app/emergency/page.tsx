"use client";

import { useState } from "react";
import { useRouter } from "next/navigation";
import Link from "next/link";

export default function CodeSubmissionPage() {
  const [code, setCode] = useState("");
  const [error, setError] = useState("");
  const router = useRouter();

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    setError("");

    // Save the code in localStorage
    localStorage.setItem("emergencyCode", code);
    router.push("/emergency/emerData");
  };
  return (
    <>
      <div className="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
        <div className="sm:mx-auto sm:w-full sm:max-w-sm">
          <h2 className="mt-10 text-center text-2xl/9 font-bold tracking-tight text-white-900">
            Insert Emergency Code
          </h2>
          <hr className="w-full justify-center" />
        </div>

        <div className="mt-10 sm:mx-auto sm:w-full sm:max-w-xl">
          <form
            onSubmit={handleSubmit}
            className="space-y-6 justify-items-center"
          >
            <div>
              <div className="flex items-center justify-between">
                <label
                  htmlFor="Fname"
                  className="block text-sm/6 font-medium text-white-900"
                >
                  Emergency Code
                </label>
              </div>
              <div className="mt-2">
                <input
                  id="Fname"
                  name="Fname"
                  type="text"
                  required
                  value={code}
                  onChange={(e) => setCode(e.target.value)}
                  className="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-black-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                />
              </div>
              <div className="mt-5">
                <button
                  type="submit"
                  className="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                >
                  Submit
                </button>
              </div>
              <Link
                href="/"
                className="flex w-full justify-center  px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:text-lg/6"
              >
                Sign out
              </Link>
            </div>
          </form>
        </div>
      </div>
    </>
  );
}
