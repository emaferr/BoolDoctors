<?php

namespace App\Http\Controllers;

use App\Message;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ChartController extends Controller
{
    public function index(){
        $id = Auth::id();

        $month = date('n');
        $year = date('Y');
        $monthName = array('','gennaio','febbraio','marzo','aprile','maggio','giugno','luglio','agosto','settembre','ottobre','novembre','dicembre');
  
        $label = array();
        $message = array();
        $review = array();

        for ($i=0; $i < 7; $i++) {
          $labelMonth = $month;
          $messages = Message::where('user_id', '=', $id)->whereMonth('created_at', '=', $labelMonth)->get();
          $reviews = Review::where('user_id', '=', $id)->whereMonth('created_at', '=', $labelMonth)->get();
          array_push($label, $labelMonth);
          array_push($message, count($messages));
          array_push($review, count($reviews));
          if ($month == 1) {
            $month = 12;
          }
          else {
            $month--;
          }
        }
  
        $labelFirst = array_reverse($label);
        $messFirst = array_reverse($message);
        $revFirst = array_reverse($review);
  
        $label = array();
        $message = array();
        $review = array();
        
        for ($i=0; $i < 7; $i++) {
          $labelYear = $year;
          $messages = Message::where('user_id', '=', $id)->whereYear('created_at', '=', $labelYear)->get();
          $reviews = Review::where('user_id', '=', $id)->whereYear('created_at', '=', $labelYear)->get();
          array_push($label, $labelYear);
          array_push($message, count($messages));
          array_push($review, count($reviews));
          $year--;
        }

        $labelSecond = array_reverse($label);
        $messSecond = array_reverse($message);
        $revSecond = array_reverse($review);
  
        for ($i=0; $i < 7; $i++) {
          $labelFirst[$i] = $monthName[$labelFirst[$i]];
        }
  
        $data = [
            'messFirst' => $messFirst,
            'labelFirst' => $labelFirst,
            'revFirst' => $revFirst,
            'messSecond' => $messSecond,
            'labelSecond' => $labelSecond,
            'revSecond' => $revSecond,
        ];

        return view('doctor.statistics', $data);

    }
}
