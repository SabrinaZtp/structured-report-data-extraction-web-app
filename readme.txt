------------------------------------------------------------
Before using this web application:
------------------------------------------------------------

Step 1: Create Table in Database
Use "tableSchema.sql" to generate table for storing the extracted data elements

Step 2: Config Database Connection
Modify "config.json"
1) serverName: name of database server. If includes "\" character, use "\\" instead
2) dbName: name of database
3) dbUsername: user name for the database. Leave empty if use Windows authentication
4) dbPassword: password for the database. Leave empty if use Windows authentication

An example config.json file:
{
"serverName" : "(local)\\SQLEXPRESS",
"dbName" : "Nodules",
"dbUsername" : "",
"dbPassword" : ""
}

Step 3: Move folder to appropriate location
Move this folder to the path where web pages are stored on your server


----------------------------------------------------------
How to use this web application:
----------------------------------------------------------

Step 1: Open "dataInput.php" in your browser

Step 2: Input data to be processed by either
1) Upload a file
Click "Choose File"/"Browse" button and select a file. (Please notice: only .txt file can be processed.)
2) Enter text into the text area
You can copy and paste the content from a file if it's not a .txt file

Step 3: Click "Extract" to process the data
Processed data will be stored in the database. Results will be presented after finishing data storage.


----------------------------------------------------------
Example:
----------------------------------------------------------

Following is a structured report fragment. 

++++++++++++++++++++++++++++++++++++++++++++++++++++++
Indeterminate or Suspicious Lung Nodules (Category 3-4B): Present 
Nodule number 1: Solid nodule in right lower lobe (2-50).
Size: 13 x 9 mm; mean diameter = 10 mm.
Evolution: Stable
LungRADS Nodule Category: 3

Nodule number 2: Ground glass nodule in left upper lobe (5-120).
Size: 10 x 15 mm; mean diameter = 12 mm.
Evolution: Stable
LungRADS Nodule Category: 4A
++++++++++++++++++++++++++++++++++++++++++++++++++++++

This web app will extract  the consistency (e.g. solid), location (e.g., right lower lobe), size (e.g., 13 x 9 mm), mean diameter (e.g., 10 mm), evolution (e.g., stable), and Lung RADS category (e.g., 3). 