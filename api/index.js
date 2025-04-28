const fs = require('fs');
const path = require('path');
const { parse } = require('url');

module.exports = async (req, res) => {
  try {
    // Parse the URL
    const parsedUrl = parse(req.url, true);
    const { pathname } = parsedUrl;

    // Handle static files
    if (pathname.startsWith('/content/')) {
      // Serve static files from the content directory
      const filePath = path.join(process.cwd(), pathname);
      
      // Check if file exists
      if (fs.existsSync(filePath)) {
        // Determine content type
        const ext = path.extname(filePath);
        let contentType = 'text/plain';
        
        if (ext === '.html' || ext === '.php') contentType = 'text/html';
        else if (ext === '.css') contentType = 'text/css';
        else if (ext === '.js') contentType = 'application/javascript';
        else if (ext === '.jpg' || ext === '.jpeg') contentType = 'image/jpeg';
        else if (ext === '.png') contentType = 'image/png';
        else if (ext === '.gif') contentType = 'image/gif';
        else if (ext === '.svg') contentType = 'image/svg+xml';
        else if (ext === '.ico') contentType = 'image/x-icon';
        
        // Set content type
        res.setHeader('Content-Type', contentType);
        
        // Read and send file
        const fileContent = fs.readFileSync(filePath);
        return res.end(fileContent);
      }
    }

    // For all other routes, serve the index.php file
    const indexPath = path.join(process.cwd(), 'index.php');
    if (fs.existsSync(indexPath)) {
      res.setHeader('Content-Type', 'text/html');
      const fileContent = fs.readFileSync(indexPath);
      return res.end(fileContent);
    }

    // If file not found
    res.statusCode = 404;
    res.end('Not Found');
  } catch (err) {
    console.error('Error occurred handling', req.url, err);
    res.statusCode = 500;
    res.end('Internal Server Error');
  }
}; 