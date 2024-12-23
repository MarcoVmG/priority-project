const grpc = require('@grpc/grpc-js');
const { connect, signers, hash } = require('@hyperledger/fabric-gateway');
const crypto = require('crypto');
const fs = require('fs/promises');
const path = require('path');

const channelName = 'mychannel';
const chaincodeName = 'ledger'; /*"basic"*/ // Update with your chaincode name
const mspId = 'Org1MSP'; // Update with your MSP ID

// Paths for certificates and keys
// This path is taking under consideration that the project is running inside the fabric-samples folder
// and the test-network folder is in the fabric-samples
const cryptoPath = path.resolve(
    __dirname,
    '../../../../../../test-network/organizations/peerOrganizations/org1.example.com'
);
const keyDirectoryPath = path.resolve(
    cryptoPath,
    'users/User1@org1.example.com/msp/keystore'
);
const certDirectoryPath = path.resolve(
    cryptoPath,
    'users/User1@org1.example.com/msp/signcerts'
);
const tlsCertPath = path.resolve(
    cryptoPath,
    'peers/peer0.org1.example.com/tls/ca.crt'
);

// Peer connection details
const peerEndpoint = 'localhost:7051';
const peerHostAlias = 'peer0.org1.example.com';

/**
 * Create a gRPC client connection to the Fabric Gateway.
 */
async function newGrpcConnection() {
    const tlsRootCert = await fs.readFile(tlsCertPath);
    const tlsCredentials = grpc.credentials.createSsl(tlsRootCert);
    return new grpc.Client(peerEndpoint, tlsCredentials, {
        'grpc.ssl_target_name_override': peerHostAlias,
    });
}

/**
 * Load the user's identity (certificate).
 */
async function newIdentity() {
    const certPath = await getFirstFile(certDirectoryPath);
    const credentials = await fs.readFile(certPath);
    return { mspId, credentials };
}

/**
 * Load the user's private key for signing transactions.
 */
async function newSigner() {
    const keyPath = await getFirstFile(keyDirectoryPath);
    const privateKeyPem = await fs.readFile(keyPath);
    const privateKey = crypto.createPrivateKey(privateKeyPem);
    return signers.newPrivateKeySigner(privateKey);
}

/**
 * Helper function to get the first file in a directory.
 */
async function getFirstFile(dirPath) {
    const files = await fs.readdir(dirPath);
    if (files.length === 0) throw new Error(`No files found in ${dirPath}`);
    return path.join(dirPath, files[0]);
}

/**
 * Submit a transaction to the Fabric network.
 * @param {string} functionName - function that will be called in the chaincode.
 * @param  {...any} args - arguments for the function.
 */
async function submitTransaction(functionName, ...args) {
    try {
        console.log('Connecting to the Fabric network...');

        const client = await newGrpcConnection();
        const gateway = connect({
            client,
            identity: await newIdentity(),
            signer: await newSigner(),
            hash: hash.sha256,
        });

        const network = gateway.getNetwork(channelName);
        const contract = network.getContract(chaincodeName);

        console.log(`Submitting transaction: ${functionName} with args:`, args);


        let result;
        // the if statement is used to determine if the function is a read(evaluateTransaction) 
        // or write operation(submitTransaction)
        if (
            [
                'CreateAsset',
                'AddUserData',
                'addMedData',
                'addEmergContact',
            ].includes(functionName)
        ) {
            result = await contract.submitTransaction(functionName, ...args);
        } else {

            result = await contract.evaluateTransaction(functionName, ...args);
        }
        // Decode the response as a UTF-8 string
        const decodedResponse = Buffer.from(result).toString('utf8');
        console.log(`Transaction result for ${functionName}:`, decodedResponse);

        gateway.close();
        client.close();

        return decodedResponse;
    } catch (error) {
        console.error('Error in submitTransaction:', error);
        throw error;
    }
}

module.exports = { submitTransaction };
