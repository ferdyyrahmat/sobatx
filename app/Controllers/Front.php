<?php 
namespace App\Controllers;

class Front extends BaseController
{
   //Login Ses
   public function index()
   {
      if (session('id') != null) {
         return redirect()->to(base_url('/peternak/dashboard'));
      }else{
         echo view('Frontend/Login/loading_page');
      }
   }

   public function user_select()
   {
      echo view('Frontend/Login/user_page');
   }

   public function register_page()
   {
      echo view('Frontend/Register/user_page');
   }

   public function page_404()
   {
      echo view('Frontend/content/error-404');
   }
   public function page_success()
   {
      echo view('Frontend/content/success-200');
   }


}