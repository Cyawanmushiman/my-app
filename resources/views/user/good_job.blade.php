@extends('layouts.user.app')

@section('content')
{{-- <style>
    div[role="region"] {
        overflow: auto;
        width: 100%;
        padding: 0.8em 0;
    }

    #Embiggen:checked~div[role="region"] {
        font-size: 200%;
    }

    #years span,
    td span,
    #Jan17,
    .sronly {
        position: absolute;
        top: auto;
        overflow: hidden;
        clip: rect(1px 1px 1px 1px);
        /* IE 6/7 */
        clip: rect(1px, 1px, 1px, 1px);
        width: 1px;
        height: 1px;
        white-space: nowrap;
    }

    table {
        font-size: 65%;
        border-collapse: separate;
        border-spacing: 0.2em 0;
    }

    caption {
        text-align: left;
        font-size: 140%;
    }

    th {
        text-align: left;
        font-weight: normal;
    }

    td {
        padding: 0;
    }

    td::after {
        content: "";
        display: block;
        box-sizing: border-box;
        width: 1em;
        height: 1em;
        background-color: #eee;
    }

    td.amta::after,
    td.amtb::after,
    td.amtc::after,
    td.amtd::after {
        display: none;
    }

    td {
        position: relative;
    }

    td a {
        display: block;
        box-sizing: border-box;
        width: 1em;
        height: 1em;
        background-color: #eee;
        z-index: 1;
        text-decoration: none;
    }

    #Borderize:checked~div[role="region"] td::after,
    #Borderize:checked~div[role="region"] td a {
        /* border: .01em solid #767676; */
        /* 4.5:1 */
        border: .01em solid #949494;
        /* 3:1 */
    }

    td a:hover,
    td a:focus {
        text-decoration: none;
        outline: 0.1em solid #00d;
    }

    td.amta a {
        background-color: #c6e48b;
    }

    td.amtb a {
        background-color: #7bc96f;
    }

    td.amtc a {
        background-color: #239a3b;
    }

    td.amtd a {
        background-color: #196127;
    }

    #Toggle:checked~div[role="region"] td.amta a {
        background-image: linear-gradient(to bottom right,
                #eee 0%,
                #eee 75%,
                #196127 75%,
                #196127 100%);
    }

    #Toggle:checked~div[role="region"] td.amtb a {
        background-image: linear-gradient(to bottom right,
                #eee 0%,
                #eee 50%,
                #196127 50%,
                #196127 100%);
    }

    #Toggle:checked~div[role="region"] td.amtc a {
        background-image: linear-gradient(to bottom right,
                #eee 0%,
                #eee 25%,
                #196127 25%,
                #196127 100%);
    }

    #Toggle:checked~div[role="region"] td.amtd a {
        background-color: #196127;
    }

    td[class^="amt"] a:focus::before,
    td[class^="amt"] a:hover::before {
        position: absolute;
        display: block;
        z-index: 1;
        bottom: 1.5em;
        left: -1em;
        width: 12em;
        max-width: 57em;
        padding: 0.5em 0.75em;
        border: 0.05em solid rgba(255, 255, 255, 1);
        border-radius: 0.2em;
        box-shadow: 0.15em 0.15em 0.5em rgba(0, 0, 0, 1);
        content: attr(aria-label);
        background-color: rgba(0, 0, 0, 0.85);
        color: rgba(255, 255, 255, 1);
        font-size: 110%;
        animation: TOOLTIP 0.1s ease-out 1;
    }

    td[class^="amt"]:nth-child(n + 45) a:focus::before,
    td[class^="amt"]:nth-child(n + 45) a:hover::before {
        left: -12em;
    }

    /* Windows High Contrast Mode Support */
    @media screen and (-ms-high-contrast: active) {

        td.amta a,
        td.amtb a,
        td.amtc a,
        td.amtd a {
            background-color: Highlight;
        }

        #Toggle:checked~div[role="region"] td.amta a {
            background-image: linear-gradient(to bottom right,
                    Window 0%,
                    Window 75%,
                    Highlight 75%,
                    Highlight 100%);
        }

        #Toggle:checked~div[role="region"] td.amtb a {
            background-image: linear-gradient(to bottom right,
                    Window 0%,
                    Window 50%,
                    Highlight 50%,
                    Highlight 100%);
        }

        #Toggle:checked~div[role="region"] td.amtc a {
            background-image: linear-gradient(to bottom right,
                    Window 0%,
                    Window 25%,
                    Highlight 25%,
                    Highlight 100%);
        }

        #Toggle:checked~div[role="region"] td.amtd a {
            background-color: Highlight;
        }

        #Borderize:checked~div[role="region"] td::after,
        #Borderize:checked~div[role="region"] td a {
            border-color: ActiveBorder;
        }
    }

    /* The animation */

    @keyframes TOOLTIP {
        from {
            bottom: 0.5em;
            background-color: rgba(0, 0, 0, 0);
            border: 0.05em solid rgba(255, 255, 255, 0);
            color: rgba(255, 255, 255, 0);
            box-shadow: 0 0 0 rgba(0, 0, 0, 1);
        }

        to {
            bottom: 1.5em;
            background-color: rgba(0, 0, 0, 0.85);
            border: 0.05em solid rgba(255, 255, 255, 1);
            color: rgba(255, 255, 255, 1);
            box-shadow: 0.15em 0.15em 0.5em rgba(0, 0, 0, 1);
        }
    }
</style> --}}
<section class="resume-section">
    <div class="resume-section-content">
        @if ($inspire)
        <div class="fadeRight d-flex align-items-center justify-content-center">
            <img src="{{ $inspire->image_url }}" style="max-width:100px;">
            <p style="font-family: serif;">「{{ $inspire->comment }}」</p>
        </div>
        @endif

        <div class="row mb-5">
            <div class="col-12 mt-3">
                <h2 class="text-center">Achieved <span class="text-danger">{{ $consecutiveDays }}</span> consecutive
                    days</h2>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-12 mt-3 text-center">
                <a href="https://calendar.google.com/calendar/u/0/r/week" class="text-decoration-none"><i class="bi bi-calendar-date me-2"></i>Let's make plans for tomorrow!</a>
            </div>
        </div>

        {{-- <div role="region" aria-labelledby="Cap1" tabindex="0">
            <table>
                <caption id="Cap1">56 contributions in the last year</caption>
                <tr id="years">
                    <th rowspan="2" scope="col" id="w"><span>Weekday</span></th>
                    <th colspan="49" id="y17"><span>2017</span></th>
                    <th colspan="4" id="y18"><span>2018</span></th>
                </tr>
                <tr>
                    <th headers="y17" id="Jan17"><span>Jan</span></th>
                    <th colspan="4" headers="y17" id="Feb17"><span aria-hidden="true">Feb</span><span
                            class="sronly">February</span></th>
                    <th colspan="4" headers="y17" id="Mar17"><span aria-hidden="true">Mar</span><span
                            class="sronly">March</span></th>
                    <th colspan="5" headers="y17" id="Apr17"><span aria-hidden="true">Apr</span><span
                            class="sronly">April</span></th>
                    <th colspan="4" headers="y17" id="May17"><span aria-hidden="true">May</span><span
                            class="sronly">May</span></th>
                    <th colspan="4" headers="y17" id="Jun17"><span aria-hidden="true">Jun</span><span
                            class="sronly">June</span></th>
                    <th colspan="5" headers="y17" id="Jul17"><span aria-hidden="true">Jul</span><span
                            class="sronly">July</span></th>
                    <th colspan="4" headers="y17" id="Aug17"><span aria-hidden="true">Aug</span><span
                            class="sronly">August</span></th>
                    <th colspan="4" headers="y17" id="Sep17"><span aria-hidden="true">Sep</span><span
                            class="sronly">September</span></th>
                    <th colspan="5" headers="y17" id="Oct17"><span aria-hidden="true">Oct</span><span
                            class="sronly">October</span></th>
                    <th colspan="4" headers="y17" id="Nov17"><span aria-hidden="true">Nov</span><span
                            class="sronly">November</span></th>
                    <th colspan="5" headers="y17" id="Dec17"><span aria-hidden="true">Dec</span><span
                            class="sronly">December</span></th>
                    <th colspan="4" headers="y17" id="Jan18"><span aria-hidden="true">Jan</span><span
                            class="sronly">January</span></th>
                </tr>
                <tr>
                    <th scope="row" id="Sun"><span class="sronly">Sunday</span></th>
                    <td headers="Jan17 y17 Sun" class="amtb" aria-labelledby="c20170129"><a href="foo"
                            aria-label="2 contributions on January 29, 2017." id="c20170129"><span>2 contributions,
                                29</span></a></td>
                    <td headers="Feb17 y17 Sun"><span>5</span></td>
                    <td headers="Feb17 y17 Sun"><span>12</span></td>
                    <td headers="Feb17 y17 Sun"><span>19</span></td>
                    <td headers="Feb17 y17 Sun"><span>26</span></td>
                    <td headers="Mar17 y17 Sun"><span>5</span></td>
                    <td headers="Mar17 y17 Sun"><span>12</span></td>
                    <td headers="Mar17 y17 Sun"><span>19</span></td>
                    <td headers="Mar17 y17 Sun"><span>26</span></td>
                    <td headers="Apr17 y17 Sun"><span>2</span></td>
                    <td headers="Apr17 y17 Sun"><span>9</span></td>
                    <td headers="Apr17 y17 Sun"><span>16</span></td>
                    <td headers="Apr17 y17 Sun"><span>23</span></td>
                    <td headers="Apr17 y17 Sun"><span>30</span></td>
                    <td headers="May17 y17 Sun"><span>7</span></td>
                    <td headers="May17 y17 Sun"><span>14</span></td>
                    <td headers="May17 y17 Sun"><span>21</span></td>
                    <td headers="May17 y17 Sun"><span>28</span></td>
                    <td headers="Jun17 y17 Sun"><span>4</span></td>
                    <td headers="Jun17 y17 Sun"><span>11</span></td>
                    <td headers="Jun17 y17 Sun"><span>18</span></td>
                    <td headers="Jun17 y17 Sun"><span>25</span></td>
                    <td headers="Jul17 y17 Sun"><span>2</span></td>
                    <td headers="Jul17 y17 Sun"><span>9</span></td>
                    <td headers="Jul17 y17 Sun"><span>16</span></td>
                    <td headers="Jul17 y17 Sun"><span>23</span></td>
                    <td headers="Jul17 y17 Sun" class="amtb" aria-labelledby="c20170730"><a href="foo"
                            aria-label="2 contributions on July 30, 2017." id="c20170730"><span>2 contributions,
                                30</span></a></td>
                    <td headers="Aug17 y17 Sun"><span>6</span></td>
                    <td headers="Aug17 y17 Sun"><span>13</span></td>
                    <td headers="Aug17 y17 Sun"><span>20</span></td>
                    <td headers="Aug17 y17 Sun"><span>27</span></td>
                    <td headers="Sep17 y17 Sun"><span>3</span></td>
                    <td headers="Sep17 y17 Sun"><span>10</span></td>
                    <td headers="Sep17 y17 Sun"><span>17</span></td>
                    <td headers="Sep17 y17 Sun" class="amta" aria-labelledby="c20170924"><a href="foo"
                            aria-label="1 contribution on September 24, 2017." id="c20170924"><span>1 contribution,
                                24</span></a></td>
                    <td headers="Oct17 y17 Sun"><span>1</span></td>
                    <td headers="Oct17 y17 Sun"><span>8</span></td>
                    <td headers="Oct17 y17 Sun"><span>15</span></td>
                    <td headers="Oct17 y17 Sun"><span>22</span></td>
                    <td headers="Oct17 y17 Sun"><span>29</span></td>
                    <td headers="Nov17 y17 Sun"><span>5</span></td>
                    <td headers="Nov17 y17 Sun"><span>12</span></td>
                    <td headers="Nov17 y17 Sun"><span>19</span></td>
                    <td headers="Nov17 y17 Sun"><span>26</span></td>
                    <td headers="Dec17 y17 Sun"><span>3</span></td>
                    <td headers="Dec17 y17 Sun"><span>10</span></td>
                    <td headers="Dec17 y17 Sun"><span>17</span></td>
                    <td headers="Dec17 y17 Sun"><span>24</span></td>
                    <td headers="Dec17 y17 Sun"><span>31</span></td>
                    <td headers="Jan18 y18 Sun"><span>7</span></td>
                    <td headers="Jan18 y18 Sun"><span>14</span></td>
                    <td headers="Jan18 y18 Sun"><span>21</span></td>
                    <td headers="Jan18 y18 Sun"><span>28</span></td>
                </tr>
                <tr>
                    <th scope="row" id="Mon"><span aria-hidden="true">Mon</span><span class="sronly">Monday</span>
                    </th>
                    <td headers="Jan17 y17 Mon"><span>30</span></td>
                    <td headers="Feb17 y17 Mon"><span>6</span></td>
                    <td headers="Feb17 y17 Mon"><span>13</span></td>
                    <td headers="Feb17 y17 Mon"><span>20</span></td>
                    <td headers="Feb17 y17 Mon"><span>27</span></td>
                    <td headers="Mar17 y17 Mon"><span>6</span></td>
                    <td headers="Mar17 y17 Mon"><span>13</span></td>
                    <td headers="Mar17 y17 Mon"><span>20</span></td>
                    <td headers="Mar17 y17 Mon"><span>27</span></td>
                    <td headers="Apr17 y17 Mon"><span>3</span></td>
                    <td headers="Apr17 y17 Mon"><span>11</span></td>
                    <td headers="Apr17 y17 Mon"><span>17</span></td>
                    <td headers="Apr17 y17 Mon"><span>24</span></td>
                    <td headers="May17 y17 Mon"><span>1</span></td>
                    <td headers="May17 y17 Mon"><span>8</span></td>
                    <td headers="May17 y17 Mon"><span>15</span></td>
                    <td headers="May17 y17 Mon"><span>22</span></td>
                    <td headers="May17 y17 Mon"><span>29</span></td>
                    <td headers="Jun17 y17 Mon"><span>5</span></td>
                    <td headers="Jun17 y17 Mon"><span>12</span></td>
                    <td headers="Jun17 y17 Mon"><span>19</span></td>
                    <td headers="Jun17 y17 Mon"><span>26</span></td>
                    <td headers="Jul17 y17 Mon" class="amtd" aria-labelledby="c20170703"><a href="foo"
                            aria-label="5 contributions on July 3, 2017." id="c20170703"><span>5 contributions,
                                3</span></a></td>
                    <td headers="Jul17 y17 Mon"><span>10</span></td>
                    <td headers="Jul17 y17 Mon"><span>17</span></td>
                    <td headers="Jul17 y17 Mon"><span>24</span></td>
                    <td headers="Jul17 y17 Mon" class="amtb" aria-labelledby="c20170731"><a href="foo"
                            aria-label="2 contributions on July 31, 2017." id="c20170731"><span>2 contributions,
                                31</span></a></td>
                    <td headers="Aug17 y17 Mon"><span>7</span></td>
                    <td headers="Aug17 y17 Mon"><span>14</span></td>
                    <td headers="Aug17 y17 Mon"><span>21</span></td>
                    <td headers="Aug17 y17 Mon"><span>28</span></td>
                    <td headers="Sep17 y17 Mon"><span>4</span></td>
                    <td headers="Sep17 y17 Mon"><span>11</span></td>
                    <td headers="Sep17 y17 Mon" class="amta" aria-labelledby="c20170918"><a href="foo"
                            aria-label="1 contribution on September 18, 2017." id="c20170918"><span>1 contribution,
                                18</span></a></td>
                    <td headers="Sep17 y17 Mon"><span>25</span></td>
                    <td headers="Oct17 y17 Mon"><span>2</span></td>
                    <td headers="Oct17 y17 Mon"><span>9</span></td>
                    <td headers="Oct17 y17 Mon"><span>16</span></td>
                    <td headers="Oct17 y17 Mon"><span>23</span></td>
                    <td headers="Oct17 y17 Mon"><span>30</span></td>
                    <td headers="Nov17 y17 Mon"><span>6</span></td>
                    <td headers="Nov17 y17 Mon"><span>13</span></td>
                    <td headers="Nov17 y17 Mon"><span>20</span></td>
                    <td headers="Nov17 y17 Mon"><span>27</span></td>
                    <td headers="Dec17 y17 Mon"><span>4</span></td>
                    <td headers="Dec17 y17 Mon"><span>11</span></td>
                    <td headers="Dec17 y17 Mon"><span>18</span></td>
                    <td headers="Dec17 y17 Mon"><span>25</span></td>
                    <td headers="Jan18 y18 Mon"><span>1</span></td>
                    <td headers="Jan18 y18 Mon"><span>8</span></td>
                    <td headers="Jan18 y18 Mon"><span>15</span></td>
                    <td headers="Jan18 y18 Mon"><span>22</span></td>
                    <td headers="Jan18 y18 Mon" class="amtb" aria-labelledby="c20180129"><a href="foo"
                            aria-label="2 contributions on January 29, 2018." id="c20180129"><span>2 contributions,
                                29</span></a></td>
                </tr>
                <tr>
                    <th scope="row" id="Tue"><span class="sronly">Tuesday</span></th>
                    <td headers="Jan17 y17 Tue"><span>31</span></td>
                    <td headers="Feb17 y17 Tue"><span>7</span></td>
                    <td headers="Feb17 y17 Tue"><span>14</span></td>
                    <td headers="Feb17 y17 Tue"><span>21</span></td>
                    <td headers="Feb17 y17 Tue"><span>28</span></td>
                    <td headers="Mar17 y17 Tue"><span>7</span></td>
                    <td headers="Mar17 y17 Tue"><span>14</span></td>
                    <td headers="Mar17 y17 Tue"><span>21</span></td>
                    <td headers="Mar17 y17 Tue"><span>28</span></td>
                    <td headers="Apr17 y17 Tue" class="amta" aria-labelledby="c20170404"><a href="foo"
                            aria-label="1 contribution on April 4, 2017." id="c20170404"><span>1 contribution,
                                4</span></a></td>
                    <td headers="Apr17 y17 Tue"><span>12</span></td>
                    <td headers="Apr17 y17 Tue"><span>18</span></td>
                    <td headers="Apr17 y17 Tue"><span>25</span></td>
                    <td headers="May17 y17 Tue"><span>2</span></td>
                    <td headers="May17 y17 Tue"><span>8</span></td>
                    <td headers="May17 y17 Tue"><span>16</span></td>
                    <td headers="May17 y17 Tue"><span>23</span></td>
                    <td headers="May17 y17 Tue"><span>30</span></td>
                    <td headers="Jun17 y17 Tue"><span>6</span></td>
                    <td headers="Jun17 y17 Tue"><span>13</span></td>
                    <td headers="Jun17 y17 Tue"><span>20</span></td>
                    <td headers="Jun17 y17 Tue"><span>27</span></td>
                    <td headers="Jul17 y17 Tue"><span>4</span></td>
                    <td headers="Jul17 y17 Tue"><span>11</span></td>
                    <td headers="Jul17 y17 Tue"><span>18</span></td>
                    <td headers="Jul17 y17 Tue"><span>25</span></td>
                    <td headers="Aug17 y17 Tue" class="amta" aria-labelledby="c20170801"><a href="foo"
                            aria-label="1 contribution on August 1, 2017." id="c20170801"><span>1 contribution,
                                1</span></a></td>
                    <td headers="Aug17 y17 Tue"><span>8</span></td>
                    <td headers="Aug17 y17 Tue"><span>15</span></td>
                    <td headers="Aug17 y17 Tue"><span>22</span></td>
                    <td headers="Aug17 y17 Tue"><span>29</span></td>
                    <td headers="Sep17 y17 Tue"><span>5</span></td>
                    <td headers="Sep17 y17 Tue"><span>12</span></td>
                    <td headers="Sep17 y17 Tue"><span>19</span></td>
                    <td headers="Sep17 y17 Tue"><span>26</span></td>
                    <td headers="Oct17 y17 Tue"><span>3</span></td>
                    <td headers="Oct17 y17 Tue" class="amta" aria-labelledby="c20171010"><a href="foo"
                            aria-label="1 contribution on October 10, 2017." id="c20171010"><span>1 contribution,
                                10</span></a></td>
                    <td headers="Oct17 y17 Tue"><span>17</span></td>
                    <td headers="Oct17 y17 Tue"><span>24</span></td>
                    <td headers="Oct17 y17 Tue"><span>31</span></td>
                    <td headers="Nov17 y17 Tue"><span>7</span></td>
                    <td headers="Nov17 y17 Tue"><span>14</span></td>
                    <td headers="Nov17 y17 Tue"><span>21</span></td>
                    <td headers="Nov17 y17 Tue"><span>28</span></td>
                    <td headers="Dec17 y17 Tue"><span>5</span></td>
                    <td headers="Dec17 y17 Tue"><span>12</span></td>
                    <td headers="Dec17 y17 Tue"><span>19</span></td>
                    <td headers="Dec17 y17 Tue"><span>26</span></td>
                    <td headers="Jan18 y18 Tue"><span>2</span></td>
                    <td headers="Jan18 y18 Tue" class="amtc" aria-labelledby="c20180109"><a href="foo"
                            aria-label="3 contributions on January 9, 2017." id="c20180109"><span>3 contributions,
                                9</span></a></td>
                    <td headers="Jan18 y18 Tue"><span>16</span></td>
                    <td headers="Jan18 y18 Tue"><span>23</span></td>
                    <td headers="Jan18 y18 Tue"><span>30</span></td>
                </tr>
                <tr>
                    <th scope="row" id="Wed"><span aria-hidden="true">Wed</span><span class="sronly">Wednesday</span>
                    </th>
                    <td headers="Feb17 y17 Wed"><span>1</span></td>
                    <td headers="Feb17 y17 Wed"><span>8</span></td>
                    <td headers="Feb17 y17 Wed"><span>15</span></td>
                    <td headers="Feb17 y17 Wed"><span>22</span></td>
                    <td headers="Mar17 y17 Wed"><span>1</span></td>
                    <td headers="Mar17 y17 Wed"><span>8</span></td>
                    <td headers="Mar17 y17 Wed"><span>15</span></td>
                    <td headers="Mar17 y17 Wed"><span>22</span></td>
                    <td headers="Mar17 y17 Wed"><span>29</span></td>
                    <td headers="Apr17 y17 Wed"><span>5</span></td>
                    <td headers="Apr17 y17 Wed"><span>13</span></td>
                    <td headers="Apr17 y17 Wed"><span>19</span></td>
                    <td headers="Apr17 y17 Wed"><span>26</span></td>
                    <td headers="May17 y17 Wed"><span>3</span></td>
                    <td headers="May17 y17 Wed"><span>10</span></td>
                    <td headers="May17 y17 Wed"><span>17</span></td>
                    <td headers="May17 y17 Wed"><span>24</span></td>
                    <td headers="May17 y17 Wed"><span>31</span></td>
                    <td headers="Jun17 y17 Wed"><span>7</span></td>
                    <td headers="Jun17 y17 Wed"><span>14</span></td>
                    <td headers="Jun17 y17 Wed"><span>21</span></td>
                    <td headers="Jun17 y17 Wed"><span>28</span></td>
                    <td headers="Jul17 y17 Wed"><span>5</span></td>
                    <td headers="Jul17 y17 Wed"><span>12</span></td>
                    <td headers="Jul17 y17 Wed"><span>19</span></td>
                    <td headers="Jul17 y17 Wed"><span>26</span></td>
                    <td headers="Aug17 y17 Wed"><span>2</span></td>
                    <td headers="Aug17 y17 Wed" class="amtc" aria-labelledby="c20170809"><a href="foo"
                            aria-label="3 contributions on August 9, 2017." id="c20170809"><span>3 contributions,
                                9</span></a></td>
                    <td headers="Aug17 y17 Wed"><span>16</span></td>
                    <td headers="Aug17 y17 Wed"><span>23</span></td>
                    <td headers="Aug17 y17 Wed"><span>30</span></td>
                    <td headers="Sep17 y17 Wed"><span>6</span></td>
                    <td headers="Sep17 y17 Wed"><span>13</span></td>
                    <td headers="Sep17 y17 Wed" class="amtc" aria-labelledby="c20170920"><a href="foo"
                            aria-label="3 contributions on September 20, 2017." id="c20170920"><span>3
                                contributions, 20</span></a></td>
                    <td headers="Sep17 y17 Wed"><span>27</span></td>
                    <td headers="Oct17 y17 Wed"><span>4</span></td>
                    <td headers="Oct17 y17 Wed"><span>11</span></td>
                    <td headers="Oct17 y17 Wed"><span>18</span></td>
                    <td headers="Oct17 y17 Wed"><span>25</span></td>
                    <td headers="Nov17 y17 Wed"><span>1</span></td>
                    <td headers="Nov17 y17 Wed"><span>8</span></td>
                    <td headers="Nov17 y17 Wed"><span>15</span></td>
                    <td headers="Nov17 y17 Wed"><span>22</span></td>
                    <td headers="Nov17 y17 Wed"><span>29</span></td>
                    <td headers="Dec17 y17 Wed"><span>6</span></td>
                    <td headers="Dec17 y17 Wed"><span>13</span></td>
                    <td headers="Dec17 y17 Wed"><span>20</span></td>
                    <td headers="Dec17 y17 Wed" class="amta" aria-labelledby="c20171227"><a href="foo"
                            aria-label="1 contribution on December 27, 2017." id="c20171227"><span>1 contribution,
                                27</span></a></td>
                    <td headers="Jan18 y18 Wed"><span>3</span></td>
                    <td headers="Jan18 y18 Wed"><span>10</span></td>
                    <td headers="Jan18 y18 Wed" class="amta" aria-labelledby="c20180117"><a href="foo"
                            aria-label="1 contribution on January 17, 2018." id="c20180117"><span>1 contribution,
                                17</span></a></td>
                    <td headers="Jan18 y18 Wed"><span>24</span></td>
                    <td headers="Jan18 y18 Wed"><span>31</span></td>
                </tr>
                <tr>
                    <th scope="row" id="Thu"><span class="sronly">Thursday</span></th>
                    <td headers="Feb17 y17 Thu"><span>2</span></td>
                    <td headers="Feb17 y17 Thu"><span>9</span></td>
                    <td headers="Feb17 y17 Thu"><span>16</span></td>
                    <td headers="Feb17 y17 Thu"><span>23</span></td>
                    <td headers="Mar17 y17 Thu"><span>2</span></td>
                    <td headers="Mar17 y17 Thu"><span>9</span></td>
                    <td headers="Mar17 y17 Thu"><span>16</span></td>
                    <td headers="Mar17 y17 Thu"><span>23</span></td>
                    <td headers="Mar17 y17 Thu" class="amta" aria-labelledby="c20170330"><a href="foo"
                            aria-label="1 contribution on March 30, 2017." id="c20170330"><span>1 contribution,
                                30</span></a></td>
                    <td headers="Apr17 y17 Thu"><span>6</span></td>
                    <td headers="Apr17 y17 Thu"><span>13</span></td>
                    <td headers="Apr17 y17 Thu"><span>20</span></td>
                    <td headers="Apr17 y17 Thu"><span>27</span></td>
                    <td headers="May17 y17 Thu"><span>4</span></td>
                    <td headers="May17 y17 Thu"><span>10</span></td>
                    <td headers="May17 y17 Thu"><span>18</span></td>
                    <td headers="May17 y17 Thu"><span>25</span></td>
                    <td headers="Jun17 y17 Thu"><span>1</span></td>
                    <td headers="Jun17 y17 Thu"><span>8</span></td>
                    <td headers="Jun17 y17 Thu"><span>15</span></td>
                    <td headers="Jun17 y17 Thu"><span>22</span></td>
                    <td headers="Jun17 y17 Thu" class="amtd" aria-labelledby="c20170629"><a href="foo"
                            aria-label="4 contributions on June 29, 2017." id="c20170629"><span>4 contributions,
                                29</span></a></td>
                    <td headers="Jul17 y17 Thu"><span>6</span></td>
                    <td headers="Jul17 y17 Thu"><span>13</span></td>
                    <td headers="Jul17 y17 Thu"><span>20</span></td>
                    <td headers="Jul17 y17 Thu"><span>27</span></td>
                    <td headers="Aug17 y17 Thu"><span>3</span></td>
                    <td headers="Aug17 y17 Thu"><span>10</span></td>
                    <td headers="Aug17 y17 Thu"><span>17</span></td>
                    <td headers="Aug17 y17 Thu"><span>24</span></td>
                    <td headers="Aug17 y17 Thu"><span>31</span></td>
                    <td headers="Sep17 y17 Thu"><span>7</span></td>
                    <td headers="Sep17 y17 Thu"><span>14</span></td>
                    <td headers="Sep17 y17 Thu"><span>21</span></td>
                    <td headers="Sep17 y17 Thu"><span>28</span></td>
                    <td headers="Oct17 y17 Thu"><span>5</span></td>
                    <td headers="Oct17 y17 Thu"><span>12</span></td>
                    <td headers="Oct17 y17 Thu"><span>19</span></td>
                    <td headers="Oct17 y17 Thu"><span>26</span></td>
                    <td headers="Nov17 y17 Thu"><span>2</span></td>
                    <td headers="Nov17 y17 Thu"><span>9</span></td>
                    <td headers="Nov17 y17 Thu"><span>16</span></td>
                    <td headers="Nov17 y17 Thu"><span>23</span></td>
                    <td headers="Nov17 y17 Thu"><span>30</span></td>
                    <td headers="Dec17 y17 Thu"><span>7</span></td>
                    <td headers="Dec17 y17 Thu"><span>14</span></td>
                    <td headers="Dec17 y17 Thu" class="amtc" aria-labelledby="c20171221"><a href="foo"
                            aria-label="3 contributions on December 21, 2017." id="c20171221"><span>3 contributions,
                                21</span></a></td>
                    <td headers="Dec17 y17 Thu" class="amtd" aria-labelledby="c20171228"><a href="foo"
                            aria-label="3 contributions on December 28, 2017." id="c20171228"><span>6 contributions,
                                28</span></a></td>
                    <td headers="Jan18 y18 Thu" class="amtc" aria-labelledby="c20180104"><a href="foo"
                            aria-label="3 contributions on January 4, 2018." id="c20180104"><span>3 contributions,
                                4</span></a></td>
                    <td headers="Jan18 y18 Thu"><span>11</span></td>
                    <td headers="Jan18 y18 Thu"><span>18</span></td>
                    <td headers="Jan18 y18 Thu"><span>25</span></td>
                    <td headers="Feb17 y18 Thu"><span>1</span></td>
                </tr>
                <tr>
                    <th scope="row" id="Fri"><span aria-hidden="true">Fri</span><span class="sronly">Friday</span>
                    </th>
                    <td headers="Feb17 y17 Fri"><span>3</span></td>
                    <td headers="Feb17 y17 Fri"><span>10</span></td>
                    <td headers="Feb17 y17 Fri"><span>17</span></td>
                    <td headers="Feb17 y17 Fri"><span>24</span></td>
                    <td headers="Mar17 y17 Fri"><span>3</span></td>
                    <td headers="Mar17 y17 Fri"><span>10</span></td>
                    <td headers="Mar17 y17 Fri"><span>17</span></td>
                    <td headers="Mar17 y17 Fri" class="amta" aria-labelledby="c20170324"><a href="foo"
                            aria-label="1 contribution on March 24, 2017." id="c20170324"><span>1 contribution,
                                24</span></a></td>
                    <td headers="Mar17 y17 Fri"><span>31</span></td>
                    <td headers="Apr17 y17 Fri"><span>7</span></td>
                    <td headers="Apr17 y17 Fri"><span>14</span></td>
                    <td headers="Apr17 y17 Fri"><span>21</span></td>
                    <td headers="Apr17 y17 Fri"><span>28</span></td>
                    <td headers="May17 y17 Fri"><span>5</span></td>
                    <td headers="May17 y17 Fri"><span>11</span></td>
                    <td headers="May17 y17 Fri"><span>19</span></td>
                    <td headers="May17 y17 Fri"><span>26</span></td>
                    <td headers="Jun17 y17 Fri"><span>2</span></td>
                    <td headers="Jun17 y17 Fri"><span>9</span></td>
                    <td headers="Jun17 y17 Fri"><span>16</span></td>
                    <td headers="Jun17 y17 Fri"><span>23</span></td>
                    <td headers="Jul17 y17 Fri"><span>1</span></td>
                    <td headers="Jul17 y17 Fri"><span>7</span></td>
                    <td headers="Jul17 y17 Fri"><span>14</span></td>
                    <td headers="Jul17 y17 Fri"><span>21</span></td>
                    <td headers="Jul17 y17 Fri"><span>28</span></td>
                    <td headers="Aug17 y17 Fri"><span>4</span></td>
                    <td headers="Aug17 y17 Fri"><span>11</span></td>
                    <td headers="Aug17 y17 Fri"><span>18</span></td>
                    <td headers="Aug17 y17 Fri"><span>25</span></td>
                    <td headers="Sep17 y17 Fri"><span>1</span></td>
                    <td headers="Sep17 y17 Fri"><span>8</span></td>
                    <td headers="Sep17 y17 Fri"><span>15</span></td>
                    <td headers="Sep17 y17 Fri"><span>22</span></td>
                    <td headers="Sep17 y17 Fri"><span>29</span></td>
                    <td headers="Oct17 y17 Fri"><span>6</span></td>
                    <td headers="Oct17 y17 Fri"><span>13</span></td>
                    <td headers="Oct17 y17 Fri"><span>20</span></td>
                    <td headers="Oct17 y17 Fri"><span>27</span></td>
                    <td headers="Nov17 y17 Fri"><span>3</span></td>
                    <td headers="Nov17 y17 Fri"><span>10</span></td>
                    <td headers="Nov17 y17 Fri"><span>17</span></td>
                    <td headers="Nov17 y17 Fri"><span>24</span></td>
                    <td headers="Dec17 y17 Fri"><span>1</span></td>
                    <td headers="Dec17 y17 Fri"><span>8</span></td>
                    <td headers="Dec17 y17 Fri"><span>15</span></td>
                    <td headers="Dec17 y17 Fri" class="amtb" aria-labelledby="c20171222"><a href="foo"
                            aria-label="2 contributions on December 22, 2017." id="c20171222"><span>2 contributions,
                                22</span></a></td>
                    <td headers="Dec17 y17 Fri"><span>29</span></td>
                    <td headers="Jan18 y18 Fri"><span>5</span></td>
                    <td headers="Jan18 y18 Fri"><span>12</span></td>
                    <td headers="Jan18 y18 Fri"><span>19</span></td>
                    <td headers="Jan18 y18 Fri"><span>26</span></td>
                    <td headers="Feb17 y18 Fri"><span>2</span></td>
                </tr>
                <tr>
                    <th scope="row" id="Sat"><span class="sronly">Saturday</span></th>
                    <td headers="Feb17 y17 Sat"><span>4</span></td>
                    <td headers="Feb17 y17 Sat"><span>11</span></td>
                    <td headers="Feb17 y17 Sat"><span>18</span></td>
                    <td headers="Feb17 y17 Sat"><span>25</span></td>
                    <td headers="Mar17 y17 Sat"><span>4</span></td>
                    <td headers="Mar17 y17 Sat"><span>11</span></td>
                    <td headers="Mar17 y17 Sat"><span>18</span></td>
                    <td headers="Mar17 y17 Sat"><span>25</span></td>
                    <td headers="Apr17 y17 Sat"><span>1</span></td>
                    <td headers="Apr17 y17 Sat"><span>8</span></td>
                    <td headers="Apr17 y17 Sat"><span>15</span></td>
                    <td headers="Apr17 y17 Sat"><span>22</span></td>
                    <td headers="Apr17 y17 Sat"><span>29</span></td>
                    <td headers="May17 y17 Sat"><span>6</span></td>
                    <td headers="May17 y17 Sat"><span>12</span></td>
                    <td headers="May17 y17 Sat"><span>20</span></td>
                    <td headers="May17 y17 Sat"><span>27</span></td>
                    <td headers="Jun17 y17 Sat"><span>3</span></td>
                    <td headers="Jun17 y17 Sat"><span>10</span></td>
                    <td headers="Jun17 y17 Sat"><span>17</span></td>
                    <td headers="Jun17 y17 Sat"><span>24</span></td>
                    <td headers="Jul17 y17 Sat"><span>2</span></td>
                    <td headers="Jul17 y17 Sat"><span>8</span></td>
                    <td headers="Jul17 y17 Sat"><span>15</span></td>
                    <td headers="Jul17 y17 Sat"><span>22</span></td>
                    <td headers="Jul17 y17 Sat"><span>29</span></td>
                    <td headers="Aug17 y17 Sat"><span>5</span></td>
                    <td headers="Aug17 y17 Sat"><span>12</span></td>
                    <td headers="Aug17 y17 Sat"><span>19</span></td>
                    <td headers="Aug17 y17 Sat"><span>26</span></td>
                    <td headers="Sep17 y17 Sat" class="amta" aria-labelledby="c20170902"><a href="foo"
                            aria-label="1 contribution on September 2, 2017." id="c20170902"><span>1 contribution,
                                2</span></a></td>
                    <td headers="Sep17 y17 Sat"><span>9</span></td>
                    <td headers="Sep17 y17 Sat"><span>16</span></td>
                    <td headers="Sep17 y17 Sat"><span>23</span></td>
                    <td headers="Sep17 y17 Sat"><span>30</span></td>
                    <td headers="Oct17 y17 Sat"><span>7</span></td>
                    <td headers="Oct17 y17 Sat"><span>14</span></td>
                    <td headers="Oct17 y17 Sat"><span>21</span></td>
                    <td headers="Oct17 y17 Sat"><span>28</span></td>
                    <td headers="Nov17 y17 Sat"><span>4</span></td>
                    <td headers="Nov17 y17 Sat"><span>11</span></td>
                    <td headers="Nov17 y17 Sat"><span>18</span></td>
                    <td headers="Nov17 y17 Sat"><span>25</span></td>
                    <td headers="Dec17 y17 Sat"><span>2</span></td>
                    <td headers="Dec17 y17 Sat"><span>9</span></td>
                    <td headers="Dec17 y17 Sat"><span>16</span></td>
                    <td headers="Dec17 y17 Sat" class="amtb" aria-labelledby="c20171223"><a href="foo"
                            aria-label="2 contributions on December 23, 2017." id="c20171223"><span>2 contributions,
                                23</span></a></td>
                    <td headers="Dec17 y17 Sat"><span>30</span></td>
                    <td headers="Jan18 y18 Sat" class="amtb" aria-labelledby="c20180106"><a href="foo"
                            aria-label="2 contributions on January 6, 2018." id="c20180106"><span>2 contributions,
                                6</span></a></td>
                    <td headers="Jan18 y18 Sat"><span>13</span></td>
                    <td headers="Jan18 y18 Sat" class="amtb" aria-labelledby="c20180120"><a href="foo"
                            aria-label="2 contributions on January 20, 2018." id="c20180120"><span>2 contributions,
                                20</span></a></td>
                    <td headers="Jan18 y18 Sat"><span>27</span></td>
                    <td headers="Feb17 y18 Sat"></td>
                </tr>
            </table>
        </div> --}}
        @for ($i = 0; $i < $dailyScores->count(); $i++)
            @if ($dailyScores[$i]->score >= 80)
            <i class="fa-solid fa-fire-flame-curved text-danger"></i>
            @elseif ($dailyScores[$i]->score >= 60)
            <i class="fa-solid fa-fire-flame-curved text-warning"></i>
            @elseif ($dailyScores[$i]->score >= 40)
            <i class="fa-solid fa-fire-flame-curved text-info"></i>
            @elseif ($dailyScores[$i]->score >= 20)
            <i class="fa-solid fa-fire-flame-curved text-primary"></i>
            @else
            <i class="fa-solid fa-fire-flame-curved text-secondary"></i>
            @endif
        @endfor
    </div>
</section>
@endsection