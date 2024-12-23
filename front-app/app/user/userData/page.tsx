"use client";

import React, { useState } from "react";
import { useRouter } from "next/navigation";
import Link from "next/link";

export default function UserData() {
  const [formData, setFormData] = useState({
    Fname: "",
    Lname: "",
    Address: "",
    DOB: "",
    Phone: "",
  });
  const [message, setMessage] = useState(""); // To display success/error messages
  const router = useRouter(); // For navigation

  // Handle input changes
  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const { name, value } = e.target;
    setFormData({ ...formData, [name]: value });
  };

  // Handle form submission
  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setMessage("");

    try {
      const response = await fetch("/api/user/userData", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          Authorization: `Bearer ${localStorage.getItem("token")}`, // Pass the token for authentication
        },
        body: JSON.stringify(formData),
      });

      if (response.ok) {
        setMessage("User data submitted successfully!");
        setTimeout(() => router.push("/user"), 2000); // Redirect after success
      } else {
        const error = await response.json();
        setMessage(`Error: ${error.message}`);
      }
    } catch (error) {
      setMessage("Something went wrong. Please try again.");
    }
  };

  return (
    <>
      <div className="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
        <div className="sm:mx-auto sm:w-full sm:max-w-sm">
          <h2 className="mt-10 text-center text-2xl/9 font-bold tracking-tight text-white-900">
            User Data
          </h2>
        </div>

        <div className="mt-10 sm:mx-auto sm:w-full sm:max-w-xl">
          <form onSubmit={handleSubmit} method="POST" className="space-y-6">
            <div className="grid grid-cols-1 gap-4">
              <div>
                <div className="flex items-center justify-between">
                  <label
                    htmlFor="Fname"
                    className="block text-sm/6 font-medium text-white-900"
                  >
                    First Name
                  </label>
                </div>
                <div className="mt-2">
                  <input
                    id="Fname"
                    name="Fname"
                    type="text"
                    onChange={handleChange}
                    value={formData.Fname}
                    required
                    autoComplete="given-name"
                    className="block w-full rounded-md bg-white px-3 py-1.5 text-base text-black outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-black-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                  />
                </div>
              </div>
              <div>
                <div className="flex items-center justify-between">
                  <label
                    htmlFor="Lname"
                    className="block text-sm/6 font-medium text-white-900"
                  >
                    Last Name
                  </label>
                </div>
                <div className="mt-2">
                  <input
                    id="Lname"
                    name="Lname"
                    type="text"
                    onChange={handleChange}
                    value={formData.Lname}
                    required
                    className="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-black-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                  />
                </div>
              </div>

              <div>
                <div className="flex items-center justify-between">
                  <label
                    htmlFor="phone"
                    className="block text-sm/6 font-medium text-white-900"
                  >
                    Phone Number
                  </label>
                </div>
                <div className="mt-2">
                  <input
                    id="Phone"
                    name="Phone"
                    type="tel"
                    onChange={handleChange}
                    value={formData.Phone}
                    required
                    className="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-black-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                  />
                </div>
              </div>
              <div>
                <div className="flex items-center justify-between">
                  <label
                    htmlFor="dob"
                    className="block text-sm/6 font-medium text-white-900"
                  >
                    Date of Birth
                  </label>
                </div>
                <div className="mt-2">
                  <input
                    id="DOB"
                    name="DOB"
                    type="date"
                    onChange={handleChange}
                    value={formData.DOB}
                    required
                    className="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-black-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                  />
                </div>
              </div>
              <div>
                <div className="flex items-center justify-between">
                  <label
                    htmlFor="address"
                    className="block text-sm/6 font-medium text-white-900"
                  >
                    Address
                  </label>
                </div>
                <div className="mt-2">
                  <input
                    id="Address"
                    name="Address"
                    type="text"
                    onChange={handleChange}
                    value={formData.Address}
                    required
                    className="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-black-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                  />
                </div>
              </div>
            </div>
            <div>
              <button
                type="submit"
                className="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
              >
                Submit
              </button>
            </div>
            <Link
              href="/user"
              className="flex w-full justify-center  px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:text-lg/6"
            >
              Cancel
            </Link>
          </form>
          <p>{message}</p>
        </div>
      </div>
    </>
  );
}
