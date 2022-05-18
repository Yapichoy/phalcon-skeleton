{% extends 'templates/base.volt' %}
{% block title %} {{ title }} - Phalcon is Awesome {% endblock %}
{% block content %} 
    {{ partial('includes/header') }}
    <p>{{ title }} layout</p>
    {{ content() }} 
{% endblock %}