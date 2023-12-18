<?php

namespace app\routes;

class Routes
{
  public static function get()
  {
    return [
      "get" => [
        // BASE ROUTES
        "/" => 'BaseController@home',
        "/about" => 'BaseController@about',
        "/team" => 'BaseController@team',
        "/testimonials" => 'BaseController@testimonials',
        "/contact" => 'BaseController@contact',

        "/login" => 'BaseController@login',
        "/register" => 'BaseController@register',

        // PRODUCTS ROUTES
        "/products" => 'BaseController@products',
        "/products/details/[0-9]+" => 'BaseController@productDetails',

        // PORTIFOLIO ROUTES
        "/portfolio" => 'BaseController@portfolio',
        "/portfolio/details/[0-9]+" => 'BaseController@portfolioDetails',

        // SERVICES ROUTES
        "/services" => 'BaseController@services',
        "/services/details/[0-9]+" => 'BaseController@serviceDetails',

        // BLOG ROUTES
        "/blog" => 'BaseController@blog',
        "/blog/details/[0-9]+" => 'BaseController@blogDetails',

        // ADMIN ROUTES
        "/admin" => 'AdminController@login',
        "/admin/home" => 'AdminController@home',
        "/admin/employees" => 'AdminController@employees',
        "/admin/team" => 'AdminController@team',
        "/admin/customers" => 'AdminController@customers',
        "/admin/testimonials" => 'AdminController@testimonials',
        "/admin/portfolio" => 'AdminController@portfolio',
        "/admin/services" => 'AdminController@services',
        "/admin/blog" => 'AdminController@blog',

        "/admin/orders" => 'AdminController@orders',
        "/admin/orders/details/[0-9]+" => 'AdminController@ordersDetails',

        "/admin/category" => 'AdminController@category',
        "/admin/product" => 'AdminController@product',
        "/admin/messages" => 'AdminController@messages',

      ],
    ];
  }
};