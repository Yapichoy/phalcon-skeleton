{% extends 'templates/base.volt' %}
{% block title %} {{ title }} - Phalcon is Awesome {% endblock %}
{% block content %}
    {{ content() }} 
{% endblock %}