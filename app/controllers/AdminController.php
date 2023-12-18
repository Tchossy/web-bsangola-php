<?php

namespace app\controllers;

use app\controllers\Controller;

class AdminController
{
  public function home()
  {
    return AdminTemplateController::view("home");
  }
  // employees
  public function employees()
  {
    return AdminTemplateController::view("employees");
  }
  // team
  public function team()
  {
    return AdminTemplateController::view("team");
  }
  // customers
  public function customers()
  {
    return AdminTemplateController::view("customers");
  }
  // testimonials
  public function testimonials()
  {
    return AdminTemplateController::view("testimonials");
  }
  // portfolio
  public function portfolio()
  {
    return AdminTemplateController::view("portfolio");
  }
  // services
  public function services()
  {
    return AdminTemplateController::view("services");
  }
  // blog
  public function blog()
  {
    return AdminTemplateController::view("blog");
  }

  // orders
  public function orders()
  {
    return AdminTemplateController::view("orders");
  }
  public function ordersDetails()
  {
    return AdminTemplateController::view("ordersDetails");
  }
  // category
  public function category()
  {
    return AdminTemplateController::view("category");
  }
  // product
  public function product()
  {
    return AdminTemplateController::view("product");
  }
  // messages
  public function messages()
  {
    return AdminTemplateController::view("messages");
  }

  // login
  public function login()
  {
    return AdminTemplateController::view("login");
  }
}