const fs = require('fs');
const pdfParse = require('pdf-parse');

let dataBuffer = fs.readFileSync('public/files/scouting_football_v3 (1).pdf');

pdfParse(dataBuffer).then(function(data) {
    console.log(data.text);
}).catch(function(err) {
    console.error(err);
});
