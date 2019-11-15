
<h2>Sms service </h2>

A complete project to send  SMS with Restful API

<h3>Introduction</h3>
This service makes a confident service to send SMS. It uses two different API to rise reliability. These apis haven't been implemented, so they are mock. To show that sending SMS was successful or nor, they just return true or false randomly.


<h4> Sending sms</h4>
Clients can send the information of the message both API and a user interface. The service can handle the sms in
 two different ways including: 
 
  1. sending immediately
  2. inserting in a queue and sending to the API later
Call API: 

    
     http://127.0.0.1:8000/api/sms/send?body=Hello&mobile=09120000000
<hr />
<h4> Technical</h4>  
Used techniques are presented in the following:

Language:
<ul>
<li>PHP 7.2.*</li>
<li>CSS3</li>
<li>JS</li>
<li>HTML5</li>
</ul>

Framework and Library:
<ul>
<li>Laravel version 6.*</li>
<li>Vuejs</li>
<li>Jquery</li>
</ul>

tools:
<ul>
<li>Docker</li>
<li>Compose</li>
<li>Git</li>
</ul>

Other:
<ul>
<li>PHPUnit</li>
<li>Object orinted</li>
<li>SOLID</li>
<li>Design Pattern</li>
<li>CMemcashed</li>
<li>Queue Laravel</li>
</ul>
<hr />

<h3>description</h3>

As mentioned above, the service uses verity of programming languages, frameworks, and tools, so it is 
explained why they have been chosen in the following:

<h4>Laravel and Vuejs</h4>

 Laravel is one of the popular frameworks among PHP developers because it provides tones of services and facilities to make reliable projects. As well Vue.js is an open-source JavaScript framework for building user interfaces that helps you to create a strong application in front-end. These two frameworks are matching each other well.
 
<h4>SOLID and design patterns</h4>

The service uses a few different external services to send SMS, so there has implemented a structure based on object-oriented 
and SOLID. These files are available in the path: /app/classes/SMS. 
First, it has created an interface that all API have to include the functions of the interface. Also, there have been used 
of the design pattern such as Factory.

 <h4>Caching</h4>
  This service creates some reports about the sent SMS. this data is cached raising the performance of the application.
  We use Memcached to handle caching. The service will fresh the data of caching after a few minutes.
  
  <h4>Queue</h4>
  There is a variable (USE_SMS_QUEUE) in the .env file that you can determine if the sms is queued or not. 
  If you want to use the queue, set the value of USE_SMS_QUEUE to true in .env file
 
 <hr/>
 
<h3>install</h3> 

<h5>a) Manual</h5>
 Prerequisites:
  <ul>
    <li>PHP 7.2</li>
    <li>Nginx or Apache2</li>
    <li>Mysql (If you want to use database as a data source)</li>
    <li>Memcached</li>
  </ul>
1. Install the above requirement
2. Clone the source code from github repository. To do that open terminal and type the following command:
     
     
       git clone https://github.com/Javad-ALirezaeyan/smsService.git
       
3.Then, open the smsService directory with command: 
 
    cd smsService    
      
4. Run the following command in the terminal:
      
      
      php artisan make:install

Note: Please set the configuration of database  in .env file, otherwise the above command make an error.
 

<h5>b) By docker</h5>
 
 1. Clone the source code from github repository. To do that open terminal and type the following command:
  
  
    git clone https://github.com/Javad-ALirezaeyan/smsService.git
   
          
 2. Then, open the smsService directory with command: 
 
 <code>cd smsService </code>
  
  and run the following commands  to build nginx, mysql and laravel project to the containers of docker
    
 
        docker-compose build
        docker-compose up -d
  
  
  
   
   
 you should see printed comments in the following:
 
      
       Creating app       ... done
       
       Creating webserver ... done
       
       Creating db        ... done
     
    
 3. Now, the necessary files and software have been installed on your computer. Type the following code to see a container on docker service:
 
    <code>
    docker-compose ps
    </code>
    
you should see something like the following  text after running the above command:


 
    CONTAINER ID        IMAGE                  COMMAND                  CREATED             STATUS              PORTS                                      NAMES
    
    9ae2ab01f3ab        nginx:alpine           "nginx -g 'daemon of…"   14 hours ago        Up 9 minutes        0.0.0.0:80->80/tcp, 0.0.0.0:443->443/tcp   webserver
    
    c583fd40ab38        digitalocean.com/php   "docker-php-entrypoi…"   14 hours ago        Up 9 minutes        9000/tcp                                   app
    
    ea6aab48faf9        mysql:5.7.22           "docker-entrypoint.s…"   14 hours ago        Up 9 minutes        0.0.0.0:3306->3306/tcp                     db




 4. You can now modify the .env file on the app container to include specific details about your setup.
    
  Open the file using 
  
  <code>docker-compose exec</code>, 
  
 which allows you to run specific commands in containers.
   In this case, you are opening the file for editing:
  
  <ul>
  <li><code>DB_HOST</code> will be your <code>db</code> database container. </li>
  <li><code>DB_DATABASE</code> will be the <code><span class="highlight">email</span></code> database. </li>
  <li><code>DB_USERNAME</code> will be the username you will use for your database. In this case, we will use <code><span class="highlight">root</span></code>. </li>
  <li><code>DB_PASSWORD</code> will be the secure password you would like to use for this user account. the default password is <code>qaz</code> </li>
  </ul>
  
  <pre class="code-pre "><code langs="">
  DB_CONNECTION=mysql
  DB_HOST=<span class="highlight">db</span>
  DB_PORT=3306
  DB_DATABASE=<span class="highlight">email</span>
  DB_USERNAME=<span class="highlight">root</span>
  DB_PASSWORD=<span class="highlight">qaz</span>
  </code></pre>
  
  Save your changes and exit your editor. 
  
  
  5. Now, You can install the project by this command: 
  
    <code>
    docker-compose exec app php artisan make:install
    </code>
 
 
 As a final step,  visit http://your_server_ip:8000 in the browser.
 
 
 
<h4>screenshots</h4>
   ![alt text](https://github.com/Javad-Alirezaeyan/smsService/blob/master/screenshots/1.png)
   ![alt text](https://github.com/Javad-Alirezaeyan/smsService/blob/master/screenshots/2.png)
   ![alt text](https://github.com/Javad-Alirezaeyan/smsService/blob/master/screenshots/3.png)
   ![alt text](https://github.com/Javad-Alirezaeyan/smsService/blob/master/screenshots/4.png)
   ![alt text](https://github.com/Javad-Alirezaeyan/smsService/blob/master/screenshots/5.png)
    