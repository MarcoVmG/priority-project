- Prerequisites link to check. Note: the project was developed using Windows machine.
https://hyperledger-fabric.readthedocs.io/en/latest/prereqs.html


- Download the fabric-samples installer from GitHub repository

    curl -sSLO https://raw.githubusercontent.com/hyperledger/fabric/main/scripts/install-fabric.sh && chmod +x install-fabric.sh


- Install fabric-samples

    ./install-fabric.sh

- In the fabric-samples folder add the project-priority folder which contains the code of the application.

- Navigate to the chaincode folder and use the command npm install to install all the node_modules.

- Navigate to the front-app folder and insert npm install, then use npm run dev to deploy locally the project.

- Navigate to the test-network folder and use the command "./network.sh up createChannel -s couchdb" to initialize the test-network that will use the CouchDB to local storage.

- After the initialization use the command './network.sh deployCC -ccn ledger -ccp ../project-priority/chaincode/ -ccl javascript -ccep "OR('Org1MSP.peer','Org2MSP.peer')"' to install the chaincode into the tes-network.

- Once this process is finish the application will be able to interact with the test-network.

- Go in the navigation application and navigate to "http://localhost:3000/" to access the application.

- Then to access to the CouchDB UI use "http://localhost:5984/_utils/" username: admin and password: adminpw. Once inside is possible to see the assets data on "mychannel_ledger"
