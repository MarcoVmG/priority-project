import { submitTransaction } from "../gateway";// Import gateway logic
import bcrypt from 'bcrypt';
import jwt from 'jsonwebtoken';
import dotenv from 'dotenv';

dotenv.config();

export async function POST(req) {
    const JWT_SECRET = process.env.JWT_SECRET || 'default_secret';

    try {
        const body = await req.json();
        const { email, password } = body;

        if (!email || !password) {
            return new Response(
                JSON.stringify({ message: 'All fields are required!' }),
                { status: 400, headers: { 'Content-Type': 'application/json' } }
            );
        }
        let user = 'user';
        if(email.endsWith('@nhs.net')){ 
            user = 'emergency-team';
          }


        // Call the Hyperledger Fabric transaction
        const rawUsers = await submitTransaction("QueryByEmailAndRole", email, user);

        // Log and parse the response
        console.log('Raw data from GetAllAssets:', rawUsers);

         // Parse the raw response as JSON
         const usersParsed = JSON.parse(rawUsers);
        console.log(usersParsed)
        
        if (email !== usersParsed.Email) {
            return new Response(
                JSON.stringify({ message: 'User not found!' }),
                { status: 404, headers: { 'Content-Type': 'application/json' } }
            );
        }

        const isPasswordValid = await bcrypt.compare(password, usersParsed.Password);

        if (!isPasswordValid) {
            return new Response(
                JSON.stringify({ message: 'Invalid password!' }),
                { status: 401, headers: { 'Content-Type': 'application/json' } }
            );
        }

        const token = jwt.sign(
            { id: usersParsed.ID, email: usersParsed.Email, role: usersParsed.Role },
            JWT_SECRET,
            { expiresIn: '2h' } // Set token expiration
        );

        let url = '/user';
        if(usersParsed.Role === 'emergency-team'){
            url = '/emergency';
        }

        return new Response(JSON.stringify({ message: 'Login successful' , token, url}), {
            status: 200,
            headers: { 'Content-Type': 'application/json' },
        });
    } catch (error) {
        console.error('Error in login:', error);
        return new Response(
            JSON.stringify({ message: 'Something went wrong!' }),
            { status: 500, headers: { 'Content-Type': 'application/json' } }
        );
    }
}

