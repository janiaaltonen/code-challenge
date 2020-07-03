# Instructions to run cloned Django project 

1. clone the project:

```
git clone git@github.com:janiaaltonen/code-challenge.git
```

2. create and start virtual environment:

```
cd/code-challenge

cd/restApi

python3.x -m venv venv

source venv/bin/activate
```

3. install the project dependencies:

```
pip install -r requirements.txt
```

4. then run:

``` python
python manage.py migrate
```

5. create admin account:

``` python
python manage.py createsuperuser
```

* in case you want php client to work without modifying it
    * username: jani
    * password: jani


6. start development server: 

```
python manage.py runserver  # starts server in http://127.0.0.1:8000/
```

