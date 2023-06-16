const express = require('express');
const multer = require('multer');
const nodemailer = require('nodemailer');
const path = require('path');

const app = express();
const port = 3000;

// Set up the file upload storage
const storage = multer.diskStorage({
  destination: './uploads/',
  filename: (req, file, cb) => {
    cb(null, file.fieldname + '-' + Date.now() + path.extname(file.originalname));
  }
});

// Initialize multer middleware
const upload = multer({
  storage: storage
}).single('file'); // 'file' should match the name attribute in your form input

// Serve the HTML file with the form
app.get('/', (req, res) => {
  res.sendFile(__dirname + '/index.html');
});

// Handle the form submission
app.post('/submit', (req, res) => {
  upload(req, res, (err) => {
    if (err) {
      res.send('Error uploading file.');
    } else {
      // File uploaded successfully (if applicable)

      // Get the form data
      const { name, email, subject, message } = req.body;

      // Create a nodemailer transporter
      const transporter = nodemailer.createTransport({
        service: 'your-email-service',
        auth: {
          user: 'your-email@example.com',
          pass: 'your-email-password'
        }
      });

      // Compose the email
      const mailOptions = {
        from: 'your-email@example.com',
        to: 'your-personal-email@example.com',
        subject: 'New Contact Form Submission',
        html: `
          <p>Name: ${name}</p>
          <p>Email: ${email}</p>
          <p>Subject: ${subject}</p>
          <p>Message: ${message}</p>
        `
      };

      // Send the email
      transporter.sendMail(mailOptions, (error, info) => {
        if (error) {
          console.log(error);
          res.send('Error sending email.');
        } else {
          console.log('Email sent: ' + info.response);
          res.send('Form submitted successfully. Email sent.');
        }
      });
    }
  });
});

// Start the server
app.listen(port, () => {
  console.log(`Server is running on port ${port}`);
});
