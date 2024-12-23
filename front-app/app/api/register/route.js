import { submitTransaction } from "../gateway";// Import gateway logic
import bcrypt from 'bcrypt';

const saltRounds = 10;

export async function POST(req) {
  try {
    const body = await req.json();
    const { email, password, password2 } = body;

    if (!email || !password || !password2) {
      return new Response(
        JSON.stringify({ message: "All fields are required!" }),
        { status: 400, headers: { "Content-Type": "application/json" } }
      );
    }

    if (password !== password2) {
      return new Response(
        JSON.stringify({ message: "Passwords do not match!" }),
        { status: 400, headers: { "Content-Type": "application/json" } }
      );
    }

    const id = `asset${Math.floor(Math.random() * 1000000)}`;
    console.log("Generated ID:", id);

    // Hash the password
    const hashedPassword = await bcrypt.hash(password, saltRounds);
    let user = 'user';
     // Generate a random emergency code
    let emergencyCode = Math.random().toString(36).substring(2, 9);

    if(email.endsWith('@nhs.net')){ 
        user = 'emergency-team';
        emergencyCode = '';
      }
   


    // Call the Hyperledger Fabric transaction
    await submitTransaction("CreateAsset", id, email, hashedPassword,user, emergencyCode);

    return new Response(
      JSON.stringify({ message: "User registered successfully!", id }),
      { status: 200, headers: { "Content-Type": "application/json" } }
    );
  } catch (error) {
    console.error("Error during transaction:", error);
    return new Response(
      JSON.stringify({ message: "Something went wrong!" }),
      { status: 500, headers: { "Content-Type": "application/json" } }
    );
  }
}

