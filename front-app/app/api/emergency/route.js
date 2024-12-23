
import { submitTransaction } from "../gateway";

export async function POST(req) {
  try{
    const body = await req.json();
    const {emergencyCode} = body;

    console.log('Emergency code:', emergencyCode);

    const rawUser = await submitTransaction("QueryByEmergencyCode", emergencyCode);

    const userParsed = JSON.parse(rawUser);

    return new Response(
      JSON.stringify(userParsed),
      { status: 200, headers: { 'Content-Type': 'application/json' } }
    );
  } catch (error){
    console.error(error);
    return new Response(
      JSON.stringify({ message: 'Error' }),
      { status: 500, headers: { 'Content-Type': 'application/json' } }
    );
  }
  
}

