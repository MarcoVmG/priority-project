"use client";

import { useEffect, useState } from "react";
import Link from "next/link";

interface EmergencyContact {
  Firstname: string;
  Lastname: string;
  Phone: string;
}

interface UserData {
  Fname: string;
  Lname: string;
  DOB: string;
  Address: string;
  Phone: string;
}

interface MedicalData {
  Allergies: string;
  BloodType: string;
  ChornicDisease: string;
  Medication: string;
  EmergencyNotes: string;
}

interface ApiResponse {
  UserData: UserData;
  MedicalData: MedicalData;
  EmergencyContact: EmergencyContact;
}

const DisplayDataPage = () => {
  const [data, setData] = useState<ApiResponse | null>(null);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchData = async () => {
      const emergencyCode = localStorage.getItem("emergencyCode");

      if (!emergencyCode) {
        setError("No emergency code found. Please go back and enter the code.");
        return;
      }

      try {
        const response = await fetch("/api/emergency", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ emergencyCode }),
        });

        if (response.ok) {
          const result: ApiResponse = await response.json();
          setData(result);
        } else {
          const error = await response.json();
          setError(error.message || "Invalid code or data not found.");
        }
      } catch (err) {
        console.error(err);
        setError("An unexpected error occurred.");
      }
    };

    fetchData();
  }, []);

  if (error) return <p style={{ color: "red" }}>{error}</p>;
  if (!data) return <p>Loading...</p>;

  return (
    <>
      <div className="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8 divide-y">
        <div className="sm:mx-auto sm:w-full sm:max-w-lg">
          <h2 className="mt-10 text-center text-2xl/9 font-bold tracking-tight text-white-900">
            Personal Data
          </h2>
          <div className="grid grid-cols-2 gap-4 my-6">
            <p>First Name: {data.UserData.Fname} </p>
            <p>Last Name: {data.UserData.Lname}</p>
            <p>Date of Birth: {data.UserData.DOB}</p>
            <p>Address: {data.UserData.Address}</p>
          </div>
        </div>
        <div className="sm:mx-auto sm:w-full sm:max-w-lg">
          <h2 className="mt-6 text-center text-2xl/9 font-bold tracking-tight text-white-900">
            Medical Data
          </h2>
          <div className="grid grid-cols-2 gap-4 my-6">
            <p>Allergies: {data.MedicalData.Allergies}</p>
            <p>BloodType: {data.MedicalData.BloodType}</p>
            <p>Chronic Disease: {data.MedicalData.ChornicDisease}</p>
            <p>Medication: {data.MedicalData.Medication}</p>
            <p>Emergency Notes: {data.MedicalData.EmergencyNotes}</p>
          </div>
        </div>
        <div className="sm:mx-auto sm:w-full sm:max-w-lg">
          <h2 className="mt-6 text-center text-2xl/9 font-bold tracking-tight text-white-900">
            Emergency Contact
          </h2>
          <div className="grid grid-cols-2 gap-4 my-6">
            <p>First Name: {data.EmergencyContact.Firstname}</p>
            <p>Last Name: {data.EmergencyContact.Lastname}</p>
            <p>Phone: {data.EmergencyContact.Phone}</p>
          </div>
        </div>
      </div>
      <Link href="/">
        <p className="flex w-full justify-center  px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:text-lg/6">
          Exit
        </p>
      </Link>
    </>
  );
};

export default DisplayDataPage;
