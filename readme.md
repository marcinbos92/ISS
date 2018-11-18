**Marcin Boś | marcin@mbosweb.pl | PHP developer | 12.12.2017**  
  
## Project information 
**Name** ISS-Locator  
**Language** PHP 7 
**Framework** Laravel 5
**Git repository** https://bitbucket.org/marcinbos92/iss/overview  
## Installation
After git clone https://bitbucket.org/marcinbos92/iss.git , you have to run *composer install* command in terminal.  
## Domain apportionments
- **IssLocator** get actual coordinates from external service
- **IssCoder** get human readable position based on coordinates
## Design patterns and choosen solutions
- Response for various strategies
- Transformers for various output types 
**Patterns:**  
- DI  
- IoC (container binding in IssServiceProvider)  
- Strategy  
- Decorator  
- Adapter
## Usage example
From console in project directory please run *php artisan serve*  
Under the http://127.0.0.1 link you should get working aplication.
