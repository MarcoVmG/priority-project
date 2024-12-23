import { submitTransaction } from "../../gateway"; // Import the gateway function
import jwt from 'jsonwebtoken';
import dotenv from 'dotenv';

dotenv.config();

export async function POST(req) {
  if (req.method !== "POST") {
    return res.status(405).json({ message: "Method not allowed" });
  }

  const token = req.headers.get("Authorization")?.split(" ")[1]; // Extract the Bearer token
  if (!token) {
    return new Response(JSON.stringify({ message: "Unauthorized" }), { status: 401 });
  }

  console.log(token);

  
  try {
    const JWT_SECRET = process.env.JWT_SECRET || "default_secret";
    const decoded = jwt.verify(token, JWT_SECRET);
    const userId = decoded.id; // Extract user ID from token

    const userData = await req.json(); // Parse the JSON body

    // Submit the transaction to the blockchain
    const result = await submitTransaction("AddUserData", userId, JSON.stringify(userData));

    return new Response(JSON.stringify({ message: "User data added successfully", result }), {
      status: 200,
    });
  } catch (error) {
    console.error("Error in /api/user/userData:", error);
    return new Response(
      JSON.stringify({ message: "Failed to add user data", error: error.message }),
      { status: 500 }
    );
  }
}