


                                    ACADEMIC TEACHING TIMETABLE SYSTEM(ATTS)

## Prerequisite 
To Install this project in your pc, they are tools needed to be filled those are
-node js
-composer that will install packages and libraries
-yarn if its possible
-xampp or lampp
-code editor 


## Installation And Running

    -clone the repository and open it in cmd 
    -then use composer install to enable the package all
    -then copy .env.example rename it to .env
    -using cmd write this command php artisan key:generate
    -then create database on your xampple then edit the .env file on database name to corresponding database you have into your pc
    -then migrate the tables into your database by using php artisan migrate
    -then run the application by using php artisan serve
    -then create a new user to access and test application
 ## How Run Application
1. Clone repository into your pc
2.then run composer install 
3. edit .env file in your program to any database name that created on your local pc or xampp
4. after run This command to Migrate and add Seeders 
5. **php artisan  migrate:refresh --seed**
6. After You can Log into  system by using
7. email for Admin or academic  is: *admin@admin.com** and password is: **password**
8. email for HOD is **royalfabrice1234@gmail.com** and password is : **123456789**
9. after You can register and student then admin must make a dicision to give him/her loan by approving the status then once student loans in again find out the status has changed 
## Files 
### MiddleWares
 1. Admin Middlware where it will check if that user hase that kind of role of admin then redirect according the rigth dashbaord
 2. User Middlware wher it will consern only to students
   
 # Authors
  _NDACYAYISENGA Fabrice_
  **_18RP01492_** 
 
 
 






## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
