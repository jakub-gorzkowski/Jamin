# Jamin
Jamin is a user-friendly event-searching application that simplifies the process of finding events based on individual preferences. Its intuitive interface enhances the ability to know about upcoming activities without the need for browsing through a variety of events.

# Table of Contents

1. [Features](#features)
2. [Technology Stack](#technology-stack)
3. [Installation](#installation)
4. [Usage](#usage)
5. [Author](#author)

## Features

- **Recommendations Just for You:** The app lets you pick what you like, so you can find events based on your interests, where you are, and the type of event you're into.
- **Your Own Profile:** Make an account and discover events that suit what you're into.
- **Easy to Use Everywhere:** The platform works well on any device, making it easy to browse and find what you want.

## Technology Stack

Project is built using a variety of technologies and tools to ensure efficiency, performance, and scalability. Below is a list of the key components:

1. **Front-End:**
   - HTML5: Markup language essential for structuring content on the web.
   - CSS3: Used for styling and layout to enhance the visual presentation of HTML elements.
   - JavaScript: Versatile scripting language that adds dynamic behavior and interactivity to web pages.

2. **Back-End:**
   - PHP8: Server-side scripting language widely used for building dynamic web applications.
   - PostgreSQL: Powerful open-source relational database employed for data storage and retrieval in the back-end.

3. **Server:**
   - Nginx: High-performance web server known for its efficiency in handling concurrent connections and serving static content.

4. **Containerization:**
   - Docker: Facilitates containerization, enabling developers to package applications and their dependencies for consistent deployment across different environments.
     
5. **Version Control:**
   - Git: Distributed version control system crucial for tracking changes in code, collaborating with others, and managing software development projects.

## Installation

The project has been Dockerized to facilitate easy setup and deployment. Follow these instructions to initiate and run the project:

1. **Clone the Repository**
2. **Navigate to the Project Directory**
3. **Docker Setup:**
Make sure Docker and Docker Compose are installed on your system. Within the project directory, you'll discover Docker configuration files in the `docker/php`, `docker/db` and `docker/nginx` directories, accompanied by a respective `Dockerfile`.
4. **Build Docker Images:**
Execute the following command: `docker-compose build`
5. **Start Docker Containers:**
Start the containers using: `docker-compose up`
6. **Access the Application:**
Once the containers are operational, access the application through your browser.

## Usage

### Login Page
Desktop | Mobile
:-------------------------:|:-------------------------:
![Login Page](sample%20shots/sample_shot_1.png) | ![Mobile Login Page](sample%20shots/sample_shot_1_mobile.png)

### Home Page
Desktop | Mobile
:-------------------------:|:-------------------------:
![Home Page](sample%20shots/sample_shot_2.png) | ![Mobile Home Page](sample%20shots/sample_shot_2_mobile.png)

### Followed Events
Desktop | Mobile
:-------------------------:|:-------------------------:
![Followed Events Page](sample%20shots/sample_shot_3.png) | ![Mobile Followed Events Page](sample%20shots/sample_shot_3_mobile.png)

### Search Page
Desktop | Mobile
:-------------------------:|:-------------------------:
![Search Page](sample%20shots/sample_shot_4.png) | ![Mobile Search Page](sample%20shots/sample_shot_4_mobile.png)

### Profile Settings Page
Desktop | Mobile
:-------------------------:|:-------------------------:
![Profile Settings Page](sample%20shots/sample_shot_5.png) | ![Mobile Profile Settings Page](sample%20shots/sample_shot_5_mobile.png)

## Author
Jakub Gorzkowski
