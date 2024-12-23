'use strict';

// Deterministic JSON.stringify()
const stringify = require('json-stringify-deterministic');
const sortKeysRecursive = require('sort-keys-recursive');
const { Contract } = require('fabric-contract-api');

class AssetTransfer extends Contract {

    // CreateAsset issues a new asset to the world state with given details.
    async CreateAsset(ctx, id, email, password, role, emergencyCode) {
        const asset = {
            ID: id,
            Email: email,
            Password: password,
            Role: role,
            EmergencyCode: emergencyCode,
            UserData :{},
            MedicalData :{},
            EmergencyContact:{}
        };

        // we insert data in alphabetic order using 'json-stringify-deterministic' and 'sort-keys-recursive'
        await ctx.stub.putState(
            id,
            Buffer.from(stringify(sortKeysRecursive(asset)))
        );
        return JSON.stringify(asset);
    }
   

    // Query the network to find a user with the email and role provided   
    async QueryByEmailAndRole(ctx, email, role) {
        const query = {
            selector: {
                Email: email,
                Role: role,
            },
        };
        const iterator = await ctx.stub.getQueryResult(JSON.stringify(query));
        const results = [];
        let result = await iterator.next();
        while (!result.done) {
            const record = JSON.parse(result.value.value.toString('utf8'));
            results.push(record);
            result = await iterator.next();
        }
        if (results.length === 0) {
            throw new Error(
                `No user found with email ${email} and role ${role}`
            );
        }
        return JSON.stringify(results[0]);
    }

    // Read the asset from the network
    async ReadAsset(ctx, id) {
        const assetJSON = await ctx.stub.getState(id);
        if (!assetJSON || assetJSON.length === 0) {
            throw new Error(`The asset ${id} does not exist`);
        }
        return assetJSON.toString();
    }
    // Add the user data into the network 
    async AddUserData(ctx, id, userData) {
        const assetJSON = await this.ReadAsset(ctx, id);
        const asset = JSON.parse(assetJSON);
    
        asset.UserData = typeof userData === "string" ? JSON.parse(userData) : userData;
        asset.UpdatedAt = new Date().toISOString();
    
        await ctx.stub.putState(id, Buffer.from(JSON.stringify(asset)));
        return JSON.stringify(asset);
    }
    // Add the medical data into the network
    async addMedData(ctx, id, medData) {
        const assetJSON = await this.ReadAsset(ctx, id);
        if (!assetJSON) {
            throw new Error(`Asset with ID ${id} does not exist.`);
        }
        const asset = JSON.parse(assetJSON);
    
        asset.MedicalData = typeof medData === "string" ? JSON.parse(medData) : medData;
        asset.UpdatedAt = new Date().toISOString();
    
        await ctx.stub.putState(id, Buffer.from(JSON.stringify(asset)));
        return JSON.stringify(asset);
    }
    // Add the emergency contact information into the network
    async addEmergContact(ctx, id, emData) {
        const assetJSON = await this.ReadAsset(ctx, id);
        if (!assetJSON) {
            throw new Error(`Asset with ID ${id} does not exist.`);
        }
        const asset = JSON.parse(assetJSON);
    
        asset.EmergencyContact = typeof emData === "string" ? JSON.parse(emData) : emData;
        asset.UpdatedAt = new Date().toISOString();
    
        await ctx.stub.putState(id, Buffer.from(JSON.stringify(asset)));
        return JSON.stringify(asset);
    }
    // Query the user by the emergency code
    async QueryByEmergencyCode(ctx, emergencyCode) {
        const query = {
            selector: {
                EmergencyCode: emergencyCode,
            },
        };
        const iterator = await ctx.stub.getQueryResult(JSON.stringify(query));
        const results = [];
        let result = await iterator.next();
        while (!result.done) {
            const record = JSON.parse(result.value.value.toString('utf8'));
            results.push(record);
            result = await iterator.next();
        }
        if (results.length === 0) {
            throw new Error(
                `No user found with emergency code ${emergencyCode}`
            );
        }
        return JSON.stringify(results[0]);
    }
}

module.exports = AssetTransfer;
