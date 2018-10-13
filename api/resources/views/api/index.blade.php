<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" href="{!! URL::asset('uploads/images/favicon.ico'); !!}" type="image/x-icon">
<script src="{!! URL::asset('assets/bsetec/js/jquery.v1.8.2.js'); !!}" type="text/javascript"></script>
<link href="{!! URL::asset('assets/bsetec/css/api_docstyles.css'); !!}" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Instasocial API</title>

<script type="text/javascript">
    $.ajaxSetup({
       headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
</script>
</head>
<body>
<h1 id="title">Instasocial API v1.1 Resources</h1>
<div id="controls">
    <ul>
        <li><a id="toggle-endpoints" href="#">Toggle All Endpoints</a></li>
        <li><a id="toggle-methods" href="#">Toggle All Methods</a></li>
    </ul>
</div>
<div id="controls">
<h3>MOBILE APPLICATION APIS</h3>
</div>
<ul>
    <li class="endpoint expanded">
        <h3 class="title"><span class="name">Methods</span>
            <ul class="actions">
                <li class="list-methods"><a href="#">List Methods</a></li>
                <li class="expand-methods"><a href="#">Expand Methods</a></li>
            </ul>
        </h3>
        <ul class="methods hidden" style="display: block;">
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">User Register</span>
                    <span class="uri">/user/register</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/register" type="hidden">
                    <span class="description">This is the function for user registration. It will be triggered while new user signup. </span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">First Name</td>
                                <td class="para">first_name</td>
                                <td class="parameter">
                                    <input name="first_name" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>First Name.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Last Name</td>
                                <td class="para">last_name</td>
                                <td class="parameter">
                                    <input name="last_name" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Last Name</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">User Name</td>
                                <td class="para">username</td>
                                <td class="parameter">
                                    <input name="username" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Name.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Password</td>
                                <td class="para">password</td>
                                <td class="parameter">
                                    <input name="password" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Password.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Email</td>
                                <td class="para">email</td>
                                <td class="parameter">
                                    <input name="email" placeholder="Required">
                                </td>
                                <td class="type">Email</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Email.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Date Of Birth</td>
                                <td class="para">dob</td>
                                <td class="parameter">
                                    <input name="dob" placeholder="Optional">
                                </td>
                                <td class="type">Date</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Date of Birth (YYYY-MM-DD).</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Gender</td>
                                <td class="para">gender</td>
                                <td class="parameter">
                                    <input name="gender" placeholder="Required">
                                </td>
                                <td class="type">Enum</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>gender (male / female / other).</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">State</td>
                                <td class="para">state</td>
                                <td class="parameter">
                                    <input name="state" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>State.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Country</td>
                                <td class="para">country</td>
                                <td class="parameter">
                                    <input name="country" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Country.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Description</td>
                                <td class="para">description</td>
                                <td class="parameter">
                                    <input name="description" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Description.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Profile Pic</td>
                                <td class="para">profile_pic</td>
                                <td class="parameter">
                                    <input name="profile_pic" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Profile pic.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Player Id</td>
                                <td class="para">player_id</td>
                                <td class="parameter">
                                    <input name="player_id" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>One Signal - Player id.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Device token</td>
                                <td class="para">device_token</td>
                                <td class="parameter">
                                    <input name="device_token" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Device token.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">device type</td>
                                <td class="para">device_type</td>
                                <td class="parameter">
                                    <input name="device_type" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Device type android or iphone.</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">User Login</span>
                    <span class="uri">/user/login</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/login" type="hidden">
                    <span class="description">This is the function for user login. It will be triggered while existing user login. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="required">
                            <tr class="required">
                                <td class="name">UserName/Email</td>
                                <td class="para">username</td>
                                <td class="parameter">
                                    <input name="username" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>UserName/Email.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Password</td>
                                <td class="para">password</td>
                                <td class="parameter">
                                    <input name="password" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Password.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Player Id</td>
                                <td class="para">player_id</td>
                                <td class="parameter">
                                    <input name="player_id" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>One Signal - Player id.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Device token</td>
                                <td class="para">device_token</td>
                                <td class="parameter">
                                    <input name="device_token" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Device token.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">device type</td>
                                <td class="para">device_type</td>
                                <td class="parameter">
                                    <input name="device_type" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Device type android or iphone.</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <!-- Forgot password -->
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Forgot Password</span>
                    <span class="uri">/user/forgotpassword</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/forgotpassword" type="hidden">
                    <span class="description">This is the function for forgot password. It will be triggered when user tried to give forgot password. Maill will be sent to user. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr class="required">
                                <td class="name">Email</td>
                                <td class="para">email</td>
                                <td class="parameter">
                                    <input name="email" placeholder="Required">
                                </td>
                                <td class="type">Email</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Email.</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>            
            <li class="method put">
                <div class="title">
                    <span class="http-method">PUT</span>
                    <span class="name">Edit Profile</span>
                    <span class="uri">/user/profile</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="PUT" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/profile" type="hidden">
                    <span class="description">This is the function for Edit profile. It will be triggered when user edits their profile information.</span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="required">
                            <tr class="required">
                                <td class="name">userid</td>
                                <td class="para">userid</td>
                                <td class="parameter">
                                    <input name="userid" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User id</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">access_token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access token.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">First name</td>
                                <td class="para">first_name</td>
                                <td class="parameter">
                                    <input name="first_name" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>First name.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Last name</td>
                                <td class="para">last_name</td>
                                <td class="parameter">
                                    <input name="last_name" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Last name.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">State</td>
                                <td class="para">state</td>
                                <td class="parameter">
                                    <input name="state" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>State.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Country</td>
                                <td class="para">country</td>
                                <td class="parameter">
                                    <input name="country" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Country.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Date Of Birth</td>
                                <td class="para">dob</td>
                                <td class="parameter">
                                    <input name="dob" placeholder="Required">
                                </td>
                                <td class="type">Date</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Date of Birth (YYYY-MM-DD).</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Gender</td>
                                <td class="para">gender</td>
                                <td class="parameter">
                                    <input name="gender" placeholder="Required">
                                </td>
                                <td class="type">Enum</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Gender (male / female / other).</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Description</td>
                                <td class="para">description</td>
                                <td class="parameter">
                                    <input name="description" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Description.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Profile Pic</td>
                                <td class="para">profile_pic</td>
                                <td class="parameter">
                                    <input name="profile_pic" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Profile pic.</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Profile Details</span>
                    <span class="uri">/user/profileinfo</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/profileinfo" type="hidden">
                    <span class="description">This is the function for profile details. It will be triggered when user views pofile page. It will return profile page information for own profile and others profile. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="required">
                            <tr class="required">
                                <td class="name">userid</td>
                                <td class="para">userid</td>
                                <td class="parameter">
                                    <input name="userid" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User id</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">access_token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access token.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">member id</td>
                                <td class="para">member_id</td>
                                <td class="parameter">
                                    <input name="member_id" placeholder="Optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Member id</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Username</td>
                                <td class="para">username</td>
                                <td class="parameter">
                                    <input name="username" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Username</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Is Admin</td>
                                <td class="para">is_admin</td>
                                <td class="parameter">
                                    <input name="is_admin" placeholder="Optional" />
                                </td>
                                <td class="type">Enum</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Is Admin(1 means, we didn't restrict, 0 means we will restrict blocked data).</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Change Password</span>
                    <span class="uri">/user/change_password</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/change_password" type="hidden">
                    <span class="description">This is the function for user change password. It will be triggered when user tried to change their password.</span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="required">
                                <td class="name">userid</td>
                                <td class="para">userid</td>
                                <td class="parameter">
                                    <input name="userid" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">access_token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">old password</td>
                                <td class="para">old_password</td>
                                <td class="parameter">
                                    <input name="old_password" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Old password.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">new password</td>
                                <td class="para">new_password</td>
                                <td class="parameter">
                                    <input name="new_password" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>New password.</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Oauth Api</span>
                    <span class="uri">/user/oauth</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/oauth" type="hidden">
                    <span class="description">This is the function for user oauth. It will be triggered while register or login using social network. </span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="required">
                                <td class="name">auth_id</td>
                                <td class="para">auth_id</td>
                                <td class="parameter">
                                    <input name="auth_id" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Auth id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">auth_type</td>
                                <td class="para">auth_type</td>
                                <td class="parameter">
                                    <input name="auth_type" placeholder="Required">
                                </td>
                                <td class="type">Enum</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Auth type facebook or twitter or google.</p></td>
                            </tr>
                             <tr class="optional">
                                <td class="name">First Name</td>
                                <td class="para">first_name</td>
                                <td class="parameter">
                                    <input name="first_name" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>First Name.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Last Name</td>
                                <td class="para">last_name</td>
                                <td class="parameter">
                                    <input name="last_name" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Last Name</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">User Name</td>
                                <td class="para">username</td>
                                <td class="parameter">
                                    <input name="username" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Name.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Email</td>
                                <td class="para">email</td>
                                <td class="parameter">
                                    <input name="email" placeholder="Optional">
                                </td>
                                <td class="type">Email</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Email.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">State</td>
                                <td class="para">state</td>
                                <td class="parameter">
                                    <input name="state" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>State.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Country</td>
                                <td class="para">country</td>
                                <td class="parameter">
                                    <input name="country" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Country.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Date Of Birth</td>
                                <td class="para">dob</td>
                                <td class="parameter">
                                    <input name="dob" placeholder="Optional">
                                </td>
                                <td class="type">Date</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Date of Birth (YYYY-MM-DD).</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Gender</td>
                                <td class="para">gender</td>
                                <td class="parameter">
                                    <input name="gender" placeholder="Optional">
                                </td>
                                <td class="type">Enum</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>gender (male / female / other)</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">ProfilePic</td>
                                <td class="para">profile_pic</td>
                                <td class="parameter">
                                    <input name="profile_pic" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Profile pic.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Description</td>
                                <td class="para">description</td>
                                <td class="parameter">
                                    <input name="description" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Description.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Player Id</td>
                                <td class="para">player_id</td>
                                <td class="parameter">
                                    <input name="player_id" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>One Signal - Player id.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Device token</td>
                                <td class="para">device_token</td>
                                <td class="parameter">
                                    <input name="device_token" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Device token.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">device type</td>
                                <td class="para">device_type</td>
                                <td class="parameter">
                                    <input name="device_type" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Device type android or iphone.</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <li class="method put">
                <div class="title">
                    <span class="http-method">PUT</span>
                    <span class="name">Update Settings</span>
                    <span class="uri">/user/settings</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="PUT" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/settings" type="hidden">
                    <span class="description">This is the function for update settings. It will be triggered when user update their settings information. </span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="required">
                                <td class="name">userid</td>
                                <td class="para">userid</td>
                                <td class="parameter">
                                    <input name="userid" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">access_token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access token.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">is_notify</td>
                                <td class="para">is_notify</td>
                                <td class="parameter">
                                    <input name="is_notify" placeholder="Optional">
                                </td>
                                <td class="type">Enum</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>is_notify 0 or 1.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">is_private</td>
                                <td class="para">is_private</td>
                                <td class="parameter">
                                    <input name="is_private" placeholder="Optional">
                                </td>
                                <td class="type">Enum</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>is_private 0 or 1</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">User List</span>
                    <span class="uri">/user/user_list</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/user_list" type="hidden">
                    <span class="description">This is the function for user list. It will be triggered while searching users. It will return list of users based on trending or latest sorting. </span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">keyword</td>
                                <td class="para">keyword</td>
                                <td class="parameter">
                                    <input name="keyword" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Search by keyword.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">sort</td>
                                <td class="para">sort</td>
                                <td class="parameter">
                                    <input name="sort" placeholder="Optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>(latest-1,trending-2).</p></td>
                            </tr>
                               <tr class="optional">
                                <td class="name">page_no</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="Optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page no.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>     
           
            
             <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Follow, UnFollow, Block and UnBlock</span>
                    <span class="uri">/user/follow_unfollow_block</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/follow_unfollow_block" type="hidden">
                    <span class="description">This is the function for user Follow, UnFollow, Block, Unblock. It will be triggered when follow, unfollow, block and unblock the particular user.</span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">type</td>
                                <td class="para">type</td>
                                <td class="parameter">
                                    <input name="type" placeholder="Required">
                                </td>
                                <td class="type">Enum</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>1-follow,2-block,3-unfollow,4-unblock.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Member ID</td>
                                <td class="para">member_id</td>
                                <td class="parameter">
                                    <input name="member_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Member id.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
             <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Block List</span>
                    <span class="uri">/user/block_list</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/block_list" type="hidden">
                    <span class="description">This is the function for user block list. It will be triggered when user viewing their blocked list. </span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">page_no</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page no.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name"> File Upload</span>
                    <span class="uri">/fileupload</span>
                </div>
                <form class="hidden" style="display: block;" enctype="multipart/form-data" id="multipart">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/fileupload" type="hidden">
                    <span class="description">This is the function for file upload. It will be triggered while uploading avatar and post. </span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr class="required">
                                <td class="name">File</td>
                                <td class="para">file</td>
                                <td class="parameter">
                                    <input type="file" name="file" id="file" />
                                    <!-- <input name="cimage" placeholder="Required"> -->
                                </td>
                                <td class="type">File</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>File.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">type</td>
                                <td class="para">type</td>
                                <td class="parameter">
                                    <input name="type" placeholder="Required">
                                </td>
                                <td class="type">Enum</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Type( avatar / post ).</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <!-- Social Image stored in local and view - start -->
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name"> Social Image Upload</span>
                    <span class="uri">/socialfileupload</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/socialfileupload" type="hidden">
                    <span class="description">This is the function for social image upload. It will be triggered while social network login or signup
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr class="required">
                                <td class="name">URL</td>
                                <td class="para">url</td>
                                <td class="parameter">
                                    <input type="text" name="url"/>
                                </td>
                                <td class="type">Url</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Url</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <!-- Social Image stored in local and view - end -->
              <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Following List</span>
                    <span class="uri">/user/following_list</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/following_list" type="hidden">
                    <span class="description">This is the function for following list. It will be triggered while viewing followings. </span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">memberid</td>
                                <td class="para">member_id</td>
                                <td class="parameter">
                                    <input name="member_id" placeholder="Optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Member id.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">username</td>
                                <td class="para">username</td>
                                <td class="parameter">
                                    <input name="username" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Username.</p></td>
                            </tr>
                              <tr class="optional">
                                <td class="name">Page no</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="Optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page no.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
             <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Followers List</span>
                    <span class="uri">/user/followers_list</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/followers_list" type="hidden">
                    <span class="description">This is the function for followers list. It will be triggered while viewing followers. </span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">memberid</td>
                                <td class="para">member_id</td>
                                <td class="parameter">
                                    <input name="member_id" placeholder="Optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Member id.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">username</td>
                                <td class="para">username</td>
                                <td class="parameter">
                                    <input name="username" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Username.</p></td>
                            </tr>
                              <tr class="optional">
                                <td class="name">Page no</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="Optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page no.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Record</td>
                                <td class="para">record</td>
                                <td class="parameter">
                                    <input name="record" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Get all follower list for <br/> add group page.</p></td>
                            </tr>
                         </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
              <!-- Get Follower list for particular user - start -->
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Get Follow Request User List</span>
                    <span class="uri">/user/requestlist</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/requestlist" type="hidden">
                    <span class="description">This is the function for follower request list. It will be triggered while user viewing their follow request. </span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Page NO</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page NO.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">
                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <!-- Get Follower list for particular user - end -->
              <!-- Follower Request Accept/Decline - end -->
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Follower Request Accept/Decline</span>
                    <span class="uri">/user/response_status</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/response_status" type="hidden">
                    <span class="description">This is the function for follow request accept and decline. It will be triggered while accepting or declining user follow request. </span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">userid</td>
                                <td class="parameter">
                                    <input name="userid" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Connect Id</td>
                                <td class="para">connect_id</td>
                                <td class="parameter">
                                    <input name="connect_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Connect Id.(user_connection table 'id').</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Follower Id</td>
                                <td class="para">follower_id</td>
                                <td class="parameter">
                                    <input name="follower_id" placeholder="Optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Follower Id ( In decline, follower_id is optional ).</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Status</td>
                                <td class="para">status</td>
                                <td class="parameter">
                                    <input name="status" placeholder="Required">
                                </td>
                                <td class="type">Enum</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Status : 1-Accept, 0-Decline.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <!-- Follower Request Accept/Decline - end -->
              <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Title and Meta infos</span>
                    <span class="uri">/metainfo</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/metainfo" type="hidden">
                    <span class="description">This is the function for getting meta information. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>


                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <!-- Delete User-->
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Delete User</span>
                    <span class="uri">/user/delete_user</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/delete_user" type="hidden">
                    <span class="description">This is the function for user delete. It will be triggered while deleting a user. </span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Delete Id</td>
                                <td class="para">u_id</td>
                                <td class="parameter">
                                    <input name="u_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Delete Id.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
             <!-- checkfor notify -->
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Notification</span>
                    <span class="uri">/user/notifications</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/notifications" type="hidden">
                    <span class="description">This is the function for notifications. It will be triggered while viewing You and following notifications.</span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Type</td>
                                <td class="para">type</td>
                                <td class="parameter">
                                    <input name="type" placeholder="Optional" />
                                </td>
                                <td class="type">Enum</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Type (1=> You, 2=> Following).</p></td>
                            </tr>
                           <tr class="optional">
                                <td class="name">Page no</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="Optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page no.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>

            <!-- checkfor notify -->
              <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Notifications Status Update</span>
                    <span class="uri">/user/notifications_update</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden" />
                    <input name="oauth" value="" type="hidden" />
                    <input name="methodUri" value="/user/notifications_update" type="hidden" />
                    <span class="description">This is the function for update notification status. It will be triggered while updating notifications status. If notification_id given, we will change status as read for particular feed. else, we will reset total unread count to 0</span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Notification id</td>
                                <td class="para">notification_id</td>
                                <td class="parameter">
                                    <input name="notification_id" placeholder="Optional" />
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Notification ids if needed send comma separetd like(1,2).</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">
                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
              <!-- Send/email options-->
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Send Email</span>
                    <span class="uri">/user/send_email</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/send_email" type="hidden">
                    <span class="description">This is the function for sending an email. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Member Id</td>
                                <td class="para">member_id</td>
                                <td class="parameter">
                                    <input name="member_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Member Id.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Email Id</td>
                                <td class="para">email_id</td>
                                <td class="parameter">
                                    <input name="email_id" placeholder="Optional">
                                </td>
                                <td class="type">Email</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Email Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Subject</td>
                                <td class="para">subject</td>
                                <td class="parameter">
                                    <input name="subject" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Subject.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Message</td>
                                <td class="para">message</td>
                                <td class="parameter">
                                    <input name="message" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Message.</p></td>
                            </tr>

                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>             
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Multiple File Upload</span>
                    <span class="uri">/feed_fileuploads</span>
                </div>
                <form class="hidden" style="display: block;" enctype="multipart/form-data" id="multiplefile">
                    <input name="httpMethod" value="POST" type="hidden" />
                    <input name="oauth" value="" type="hidden" />
                    <input name="methodUri" value="/feed_fileuploads" type="hidden" />
                    <span class="description">This is the function for upload multiple files photo and video. It will be used while uploading photo or video for add a post. </span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr class="required">
                                <td class="name">File</td>
                                <td class="para">files[]</td>
                                <td class="parameter"><input type="file" name="files[]" id="files" multiple /></td>
                                <td class="type">File</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Files.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit" />
                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <!-- Get post feeds -->
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Post Feeds</span>
                    <span class="uri">/post/feeds</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/post/feeds" type="hidden">
                    <span class="description">This is the function for getting post feeds. It will be triggered while user viewing Home screen, Profile screen and post detail screen. </span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Feed Type</td>
                                <td class="para">feed_type</td>
                                <td class="parameter">
                                    <input name="feed_type" placeholder="Required">
                                </td>
                                <td class="type">Enum</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>1-feed listing, 2-feed details, 3- Profile feed.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Feed Id</td>
                                <td class="para">feed_id</td>
                                <td class="parameter">
                                    <input name="feed_id" placeholder="Optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Feed Id.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Member Id</td>
                                <td class="para">member_id</td>
                                <td class="parameter">
                                    <input name="member_id" placeholder="Optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Member Id.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Page no</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="Optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page no.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
             <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Add Post</span>
                    <span class="uri">/post</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden" />
                    <input name="oauth" value="" type="hidden" />
                    <input name="methodUri" value="/post" type="hidden" />
                    <span class="description">This is the function for add post. It will be triggered while add a new post. </span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="required">
                            <tr class="required">
                                <td class="name">userid</td>
                                <td class="para">userid</td>
                                <td class="parameter">
                                    <input name="userid" placeholder="Required" />
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>user id</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">access_token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required" />
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access token.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Post text</td>
                                <td class="para">post_text</td>
                                <td class="parameter">
                                    <input name="post_text" placeholder="Optional" />
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Post text.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Post type</td>
                                <td class="para">post_type</td>
                                <td class="parameter">
                                    <input name="post_type" placeholder="Required" />
                                </td>
                                <td class="type">Enum</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Post type ['photo', 'video', 'both'] .</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Media data</td>
                                <td class="para">media_data</td>
                                <td class="parameter">
                                    <input name="media_data" placeholder="Required" />
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Multiple media with comma separated values. Media data = a68036bfe9343e966b3c8c15938467f4.png, aa6acc996a75176d2968b3b14d9228c5.webm, 51550ee24980bb27309138dce18bbd26.jpg, 65f6c10ead740cc597f3068b0ea46a6e.mp4.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Latitude</td>
                                <td class="para">latitude</td>
                                <td class="parameter">
                                    <input name="latitude" placeholder="Optional"/>
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Latitude.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Longitude</td>
                                <td class="para">longitude</td>
                                <td class="parameter">
                                    <input name="longitude" placeholder="Optional" />
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Longitude.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Location</td>
                                <td class="para">location</td>
                                <td class="parameter">
                                    <input name="location" placeholder="Optional" />
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Location.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">
                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>

            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Edit Post</span>
                    <span class="uri">/post/edit-feed</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden" />
                    <input name="oauth" value="" type="hidden" />
                    <input name="methodUri" value="/post/edit-feed" type="hidden" />
                    <span class="description">This is the function for edit post. It will be triggered while user edit their post text. </span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="required">
                            <tr class="required">
                                <td class="name">userid</td>
                                <td class="para">userid</td>
                                <td class="parameter">
                                    <input name="userid" placeholder="Required" />
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">access_token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required" />
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Post id</td>
                                <td class="para">post_id</td>
                                <td class="parameter">
                                    <input name="post_id" placeholder="Required" />
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Post id.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Post text</td>
                                <td class="para">post_text</td>
                                <td class="parameter">
                                    <input name="post_text" placeholder="Optional" />
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Post text.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">
                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>

            <!-- Post Action -->
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Post Action</span>
                    <span class="uri">/post/actionbt</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/post/actionbt" type="hidden">
                    <span class="description">This is the function for perform following actions (Delete, like, comments) in posts. It will be triggered while deleting a post, like and unlike a post, add comment and edit comment.</span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Post Id</td>
                                <td class="para">post_id</td>
                                <td class="parameter">
                                    <input name="post_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Post Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Action Type</td>
                                <td class="para">action_type</td>
                                <td class="parameter">
                                    <input name="action_type" placeholder="Required">
                                </td>
                                <td class="type">Enum</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>1-Delete, 2-like, 3-comments, 4-delete comment.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Description</td>
                                <td class="para">cmt_desc</td>
                                <td class="parameter">
                                    <input name="cmt_desc" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Comment Description.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Comment Id</td>
                                <td class="para">comment_id</td>
                                <td class="parameter">
                                    <input name="comment_id" placeholder="Optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Comment Id.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Post Likes</span>
                    <span class="uri">/post/likes</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/post/likes" type="hidden">
                    <span class="description">This is the function for getting post like lists. It will be triggered while viewing likes list inside post. </span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Post id</td>
                                <td class="para">post_id</td>
                                <td class="parameter">
                                    <input name="post_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Post id.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Page No</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="Optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page No.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">
                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>

            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Post Comments</span>
                    <span class="uri">/post/comments</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/post/comments" type="hidden">
                    <span class="description">This is the function for getting post comments. It will be triggered while viewing comments inside post. </span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="optional">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="Optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">postid</td>
                                <td class="para">post_id</td>
                                <td class="parameter">
                                    <input name="post_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Post id.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Page no</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="Optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page no.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>

            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Photo/Video Listing</span>
                    <span class="uri">/post/media-listing</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/post/media-listing" type="hidden">
                    <span class="description">This is the function for getting media post listing. It will be triggered while viewing media posts. </span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Feed Type</td>
                                <td class="para">feed_type</td>
                                <td class="parameter">
                                    <input name="feed_type" placeholder="Required">
                                </td>
                                <td class="type">Enum</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>1-photo, 2-video.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Member Id</td>
                                <td class="para">member_id</td>
                                <td class="parameter">
                                    <input name="member_id" placeholder="Optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Member Id.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Page no</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="Optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page no.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>

            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Get Admin Pages List</span>
                    <span class="uri">/admin/pages</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/admin/pages" type="hidden">
                    <span class="description">This is the function for getting page list. It will be triggered while viewing page list. </span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Page No</td>
                                <td class="para">page</td>
                                <td class="parameter">
                                    <input name="page" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page No.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Filter by</td>
                                <td class="para">filter</td>
                                <td class="parameter">
                                    <input name="filter" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Search option.</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>

            <!-- custom page creation action - start -->
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Page Action</span>
                    <span class="uri">/admin/pageaction</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/admin/pageaction" type="hidden">
                    <span class="description">This is the function for Page actions. It will be triggered while perform following actions (New, View, Update, Delete) in page. </span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Action Type</td>
                                <td class="para">action_type</td>
                                <td class="parameter">
                                    <input name="action_type" placeholder="Required">
                                </td>
                                <td class="type">Enum</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>1-New,2-View,3-Delete,4-Update <br/>( Delete&View need only four field:User ID, Access Token, Action Type and Page Id).</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Page Id</td>
                                <td class="para">id</td>
                                <td class="parameter">
                                    <input name="id" placeholder="Optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page Id</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Page Title</td>
                                <td class="para">title</td>
                                <td class="parameter">
                                    <input name="title" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page Title</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Page Description</td>
                                <td class="para">desc</td>
                                <td class="parameter">
                                    <input name="desc" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Description</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Page Alias Name</td>
                                <td class="para">alias</td>
                                <td class="parameter">
                                    <input name="alias" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Meta description</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Meta Key</td>
                                <td class="para">meta_key</td>
                                <td class="parameter">
                                    <input name="meta_key" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Meta kay</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Meta description</td>
                                <td class="para">meta_desc</td>
                                <td class="parameter">
                                    <input name="meta_desc" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Meta description</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Status</td>
                                <td class="para">status</td>
                                <td class="parameter">
                                    <input name="status" placeholder="Required">
                                </td>
                                <td class="type">Enum</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page Stauts ( enable/disable )</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Allow Guest</td>
                                <td class="para">allow_guest</td>
                                <td class="parameter">
                                    <input name="allow_guest" placeholder="Required">
                                </td>
                                <td class="type">Enum</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Allow Guest ( 0/1 ).</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
             <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Report Types</span>
                    <span class="uri">/report-types</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden" />
                    <input name="oauth" value="" type="hidden" />
                    <input name="methodUri" value="/report-types" type="hidden" />
                    <span class="description">This is the function for getting types of report. It will be triggered while user reporting a post.</span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">userid</td>
                                <td class="parameter">
                                    <input name="userid" placeholder="Required" />
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required" />
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
             <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Post Report</span>
                    <span class="uri">/post/report</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/post/report" type="hidden">
                    <span class="description">This is the function for post report. It will be triggered while report the particular post.</span>
                    <br><br>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">userid</td>
                                <td class="parameter">
                                    <input name="userid" placeholder="Required" />
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required" />
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Post id</td>
                                <td class="para">post_id</td>
                                <td class="parameter">
                                    <input name="post_id" placeholder="Required" />
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Post id</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Report id</td>
                                <td class="para">report_id</td>
                                <td class="parameter">
                                    <input name="report_id" placeholder="Optional" />
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Report id.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Message</td>
                                <td class="para">message</td>
                                <td class="parameter">
                                    <input name="message" placeholder="Optional" />
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Report message.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            
        </ul>
</li>
</ul>
<div id="controls">
<h3>WEB APPLICATION APIS</h3>
</div>
<ul>
    <li class="endpoint expanded">
        <h3 class="title"><span class="name">Admin Methods</span>
            <ul class="actions">
                <li class="list-methods"><a href="#">List Methods</a></li>
                <li class="expand-methods"><a href="#">Expand Methods</a></li>
            </ul>
        </h3>
        
        <ul class="methods hidden" style="display: block;">
          <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Admin Forgot Password</span>
                    <span class="uri">/user/adminforgotpwd</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/adminforgotpwd" type="hidden">
                    <span class="description">Using this api, admin can reset the password.</span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                           <tr class="required">
                                <td class="name">Email</td>
                                <td class="para">email</td>
                                <td class="parameter">
                                    <input name="email" placeholder="Required">
                                </td>
                                <td class="type">Email</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Email.</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
          </li>
          <!-- Admin Side user list Get - Start -->
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Admin Back-end User List</span>
                    <span class="uri">/adminuser/user_list</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/adminuser/user_list" type="hidden">
                    <span class="description">This is the function to list all site users who are all registered through mobile applciations. </span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">keyword</td>
                                <td class="para">keyword</td>
                                <td class="parameter">
                                    <input name="keyword" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Search by keyword.</p></td>
                            </tr>
                               <tr class="optional">
                                <td class="name">page_no</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="Optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page no.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>  
          <!-- Admin Side user list Get - End -->
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Admin Back-end Post Lists</span>
                    <span class="uri">/admin/post-lists</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/admin/post-lists" type="hidden">
                    <span class="description">This is to list all posts which are posted by users through mobile application.</span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">keyword</td>
                                <td class="para">keyword</td>
                                <td class="parameter">
                                    <input name="keyword" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>search by keyword.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">page_no</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="Optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page no.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Admin Back-end Post Details</span>
                    <span class="uri">/admin/post-details</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/admin/post-details" type="hidden">
                    <span class="description">This is the function to display the details of particular post, which are posted through mobile application.</span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Post id</td>
                                <td class="para">post_id</td>
                                <td class="parameter">
                                    <input name="post_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Post id.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">
                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Admin Back-end Post Comments List</span>
                    <span class="uri">/admin/post-comments</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/admin/post-comments" type="hidden">
                    <span class="description">This is the function to list the comments details of particular post on post detailed page.</span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Search Type</td>
                                <td class="para">search_type</td>
                                <td class="parameter">
                                    <input name="search_type" placeholder="Optional">
                                </td>
                                <td class="type">Enum</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Search Type (all, active, inactive).</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Search Text</td>
                                <td class="para">search_text</td>
                                <td class="parameter">
                                    <input name="search_text" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Search Text.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Post id</td>
                                <td class="para">post_id</td>
                                <td class="parameter">
                                    <input name="post_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Post id.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Page No</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="Optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page No.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">
                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Admin Back-end Post Likes List</span>
                    <span class="uri">/admin/post-likes</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/admin/post-likes" type="hidden">
                    <span class="description">This is the function to list the "likes details" of particular post on Post detailed page.</span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Post id</td>
                                <td class="para">post_id</td>
                                <td class="parameter">
                                    <input name="post_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Post id.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Page No</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="Optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page No.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">
                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Admin Back-end Post & Comment Status Update</span>
                    <span class="uri">/admin/post-comment-status</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/admin/post-comment-status" type="hidden">
                    <span class="description">This is the function to update post and comment status. Admin can update status as active/inactive for the specific posts or comments.  </span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Post Type</td>
                                <td class="para">post_type</td>
                                <td class="parameter">
                                    <input name="post_type" placeholder="Required">
                                </td>
                                <td class="type">Enum</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Post Type (1-post,2-comments).</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Post Status</td>
                                <td class="para">post_status</td>
                                <td class="parameter">
                                    <input name="post_status" placeholder="Required">
                                </td>
                                <td class="type">Enum</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Post Status ('active','inactive').</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Post id</td>
                                <td class="para">post_id</td>
                                <td class="parameter">
                                    <input name="post_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Post id.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Comment id</td>
                                <td class="para">comment_id</td>
                                <td class="parameter">
                                    <input name="comment_id" placeholder="Optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Comment id.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">
                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <!-- Admin profile update -->
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Update Admin Profile</span>
                    <span class="uri">/admin/updateprofile</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/admin/updateprofile" type="hidden">
                    <span class="description">It is used to edit admin profile details like firstname, lastname, email, profile picture from admin panel. </span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="required">
                            <tr class="required">
                                <td class="name">userid</td>
                                <td class="para">userid</td>
                                <td class="parameter">
                                    <input name="userid" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">access_token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Username</td>
                                <td class="para">username</td>
                                <td class="parameter">
                                    <input name="username" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Username</p></td>
                            </tr>
                             <tr class="required">
                                <td class="name">E-mail</td>
                                <td class="para">email</td>
                                <td class="parameter">
                                    <input name="email" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>E-mail.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">First name</td>
                                <td class="para">first_name</td>
                                <td class="parameter">
                                    <input name="first_name" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>First name.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Last name</td>
                                <td class="para">last_name</td>
                                <td class="parameter">
                                    <input name="last_name" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Lastname.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">State</td>
                                <td class="para">state</td>
                                <td class="parameter">
                                    <input name="state" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>State.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Country</td>
                                <td class="para">country</td>
                                <td class="parameter">
                                    <input name="country" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Country.</p></td>
                            </tr>

                            <tr class="required">
                                <td class="name">Gender</td>
                                <td class="para">gender</td>
                                <td class="parameter">
                                    <input name="gender" placeholder="Required">
                                </td>
                                <td class="type">Enum</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>gender (male / female / other).</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Profile Pic</td>
                                <td class="para">profile_pic</td>
                                <td class="parameter">
                                    <input name="profile_pic" placeholder="Optional">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Profile pic.</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <!-- Dashboard Details -->
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Dashboard Details</span>
                    <span class="uri">/admin/dashboard-details</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/admin/dashboard-details" type="hidden">
                    <span class="description">This API is used to show site insight contents like user visits, Post counts etc. on Admin Dashboard. </span> 
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="Required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required">
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Admin Back-end Post Reports List</span>
                    <span class="uri">/admin/post-report-list</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden" />
                    <input name="oauth" value="" type="hidden" />
                    <input name="methodUri" value="/admin/post-report-list" type="hidden" />
                    <span class="description">Using this api, Admin can see report's list which are all reported from mobile application users.</span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                             <tr class="required">
                                <td class="name">User Id</td>
                                <td class="para">user_id</td>
                                <td class="parameter">
                                    <input name="user_id" placeholder="Required" />
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required" />
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">keyword</td>
                                <td class="para">keyword</td>
                                <td class="parameter">
                                    <input name="keyword" placeholder="Optional" />
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>keyword.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Page No</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="Required" />
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page No.</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">
                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">User Status (Active/ Deactive) from Admin</span>
                    <span class="uri">/admin/user/status_update</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden" />
                    <input name="oauth" value="" type="hidden" />
                    <input name="methodUri" value="/admin/user/status_update" type="hidden" />
                    <span class="description">This is the function for active & deactive Front end users. Admin can change the user's account status as active or inactive from User Management.</span>
                    <br/><br/>
                    <div id="param1"></div>
                    <table class="parameters">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Parameter</th>
                                <th>Value</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="required">
                            <tr class="required">
                                <td class="name">userid</td>
                                <td class="para">userid</td>
                                <td class="parameter">
                                    <input name="userid" placeholder="Required" />
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>user id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">access_token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="Required" />
                                </td>
                                <td class="type">String</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>access_token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Member id</td>
                                <td class="para">member_id</td>
                                <td class="parameter">
                                    <input name="member_id" placeholder="Required" />
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Member id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Status</td>
                                <td class="para">status</td>
                                <td class="parameter">
                                    <input name="status" placeholder="Required" />
                                </td>
                                <td class="type">Enum</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Status (active/inactive).</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">
                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
     </ul>
    </li>
</ul>

<script src="{!! URL::asset('assets/bsetec/js/common.js') !!}" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(function() {
    $('li.method form').css('display' , 'none');
    $('form').on('submit', function() {
        var datatype = $(this).attr('id');
        var form = $(this);

        var methodtype = $(this).children('input[name=httpMethod]').val();

        var methoduri = $(this).children('input[name=methodUri]').val();
        $("#message").html("<span class='error'>API Request</span>");

        var siteurl = "{!! url() !!}";

        var realpath = siteurl + methoduri;
        if (methodtype == 'DELETE')
        {
            realpath = realpath + '?' + $(this).serialize();
        }
        if(datatype !='multipart' && datatype !='multiplefile'){
               $.ajax({
                type: methodtype,
                url: realpath, // proper url to your "store-address.php" file
                data: $(this).serialize(),
                success: function(msg)
                {
                    var msg1 = JSON.stringify(msg);
                    form.find('.my_result').text(msg1);
                },
                error: function(msg)
                {
                    var msg1 = JSON.stringify(msg);
                    form.find('.my_result').text(msg1);
                }
            });
        }

        return false;
    });

    ///multipart data submit
    $("#multipart").submit(function(e)
    {
        var form = $(this);
        var methodtype = $(this).children('input[name=httpMethod]').val();
        var methoduri = $(this).children('input[name=methodUri]').val();
        $("#message").html("<span class='error'>API Request</span>");

        var siteurl = "{!! url() !!}";

        var realpath = siteurl + methoduri;
        if (methodtype == 'DELETE')
        {
            realpath = realpath + '?' + $(this).serialize();
        }

        var formData = new FormData(this);
        $.ajax({
            url: realpath,
            type: methodtype,
            data:  formData,
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
        success: function(msg)
        {
            form.find('.my_result').text(msg);
        },
         error: function(msg)
         {
            var msg1 = JSON.stringify(msg);
            form.find('.my_result').text(msg1);
         }
        });
    });
    $("#multiform").submit();
    $("#multiplefile").submit();

    ///multiplefile data submit
    $("#multiplefile").submit(function(e)
    {
        var form = $(this);
        var methodtype = $(this).children('input[name=httpMethod]').val();
        var methoduri = $(this).children('input[name=methodUri]').val();
        $("#message").html("<span class='error'>API Request</span>");

        var siteurl = "{!! url() !!}";

        var realpath = siteurl + methoduri;
        if (methodtype == 'DELETE')
        {
            realpath = realpath + '?' + $(this).serialize();
        }

        var formData = new FormData(this);
        $.ajax({
            url: realpath,
            type: methodtype,
            data:  formData,
            mimeType:"multipart/form-data",
            contentType: false,
            cache: false,
            processData:false,
        success: function(msg)
        {
           $('input[type=file]').val(null);
            form.find('.my_result').text(msg);
        },
         error: function(msg)
         {
            var msg1 = JSON.stringify(msg);
            $('input[type=file]').val(null);
            form.find('.my_result').text(msg1);
         }
        });
    });
});
</script>
</body>
</html>

