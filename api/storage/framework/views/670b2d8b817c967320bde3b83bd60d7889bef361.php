<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="<?php echo URL::asset('bsetec/js/jquery.v1.8.2.js');; ?>" type="text/javascript"></script>
<link href="<?php echo URL::asset('bsetec/css/api_docstyles.css');; ?>" rel="stylesheet" type="text/css" /> 
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>PERISCOPE API</title>

<script type="text/javascript">
    $.ajaxSetup({
       headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
</script>   
</head>   
<body>
<h1 id="title">PERISCOPE API v1.1 Resources</h1>
<div id="controls">
    <ul>
        <li><a id="toggle-endpoints" href="#">Toggle All Endpoints</a></li>
        <li><a id="toggle-methods" href="#">Toggle All Methods</a></li>
    </ul>
</div>
<ul>
    <li class="endpoint expanded">
        <h3 class="title"><span class="name">Exam methods</span>
            <ul class="actions">
                <li class="list-methods"><a href="#">List Methods</a></li>
                <li class="expand-methods"><a href="#">Expand Methods</a></li>
            </ul>
        </h3>
        <ul class="methods hidden" style="display: block;">		
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">user register</span>
                    <span class="uri">/user/register</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/register" type="hidden">
                    <span class="description">It is used to register the user. </span>
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
                                <td class="name">First Name</td>
                                <td class="para">first_name</td>
                                <td class="parameter">
                                    <input name="first_name" placeholder="required">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>First Name.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Last Name</td>
                                <td class="para">last_name</td>
                                <td class="parameter">
                                    <input name="last_name" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Last Name</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">User Name</td>
                                <td class="para">username</td>
                                <td class="parameter">
                                    <input name="username" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Name.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Password</td>
                                <td class="para">password</td>
                                <td class="parameter">
                                    <input name="password" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Password.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Email</td>
                                <td class="para">email</td>
                                <td class="parameter">
                                    <input name="email" placeholder="required">
                                </td>
                                <td class="type">email</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Email</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">State</td>
                                <td class="para">state</td>
                                <td class="parameter">
                                    <input name="state" placeholder="required">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>State</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Country</td>
                                <td class="para">country</td>
                                <td class="parameter">
                                    <input name="country" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Country</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">ProfilePic</td>
                                <td class="para">profile_pic</td>
                                <td class="parameter">
                                    <input name="profile_pic" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Profile pic</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Device token</td>
                                <td class="para">device_token</td>
                                <td class="parameter">
                                    <input name="device_token" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Device token</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">device type</td>
                                <td class="para">device_type</td>
                                <td class="parameter">
                                    <input name="device_type" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Device type android or iphone</p></td>
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
                    <span class="name">user login</span>
                    <span class="uri">/user/login</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/login" type="hidden">
                    <span class="description">It is used to login the user. </span>
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
                                    <input name="username" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>UserName/Email</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Password</td>
                                <td class="para">password</td>
                                <td class="parameter">
                                    <input name="password" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Password.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Device token</td>
                                <td class="para">device_token</td>
                                <td class="parameter">
                                    <input name="device_token" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Device token</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">device type</td>
                                <td class="para">device_type</td>
                                <td class="parameter">
                                    <input name="device_type" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Device type android or iphone</p></td>
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
                    <span class="name">Forgot password</span>
                    <span class="uri">/user/forgotpassword</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/forgotpassword" type="hidden">
                    <span class="description">It is used to set new password. </span>
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
                                    <input name="email" placeholder="required">
                                </td>
                                <td class="type">Email</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Email</p></td>
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
                    <span class="name">Edit profile</span>
                    <span class="uri">/user/edit_profile</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/edit_profile" type="hidden">
                    <span class="description">It is used to edit the user profile. </span>
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
                                    <input name="userid" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>user id</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">access_token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>access_token.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">First name</td>
                                <td class="para">first_name</td>
                                <td class="parameter">
                                    <input name="first_name" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>First name<</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Last name</td>
                                <td class="para">last_name</td>
                                <td class="parameter">
                                    <input name="last_name" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>lastname</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">State</td>
                                <td class="para">state</td>
                                <td class="parameter">
                                    <input name="state" placeholder="required">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>State</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Country</td>
                                <td class="para">country</td>
                                <td class="parameter">
                                    <input name="country" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Country</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">ProfilePic</td>
                                <td class="para">profile_pic</td>
                                <td class="parameter">
                                    <input name="profile_pic" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Profile pic</p></td>
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
                    <span class="name">Profile details</span>
                    <span class="uri">/user/profileinfo</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/profileinfo" type="hidden">
                    <span class="description">It is used to get the user profile information. </span>
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
                                    <input name="userid" placeholder="required">
                                </td>
                                <td class="type">numeric</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>user id</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">access_token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>access_token.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">member id</td>
                                <td class="para">member_id</td>
                                <td class="parameter">
                                    <input name="member_id" placeholder="optional">
                                </td>
                                <td class="type">numeric</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Member id</p></td>
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
                    <span class="name">change password</span>
                    <span class="uri">/user/change_password</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/change_password" type="hidden">
                    <span class="description">It is used to change the user password. </span>
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
                                <td class="name">userid</td>
                                <td class="para">userid</td>
                                <td class="parameter">
                                    <input name="userid" placeholder="required">
                                </td>
                                <td class="type">numeric</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>user id</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">access_token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>access_token.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">old password</td>
                                <td class="para">old_password</td>
                                <td class="parameter">
                                    <input name="old_password" placeholder="required">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>old password</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">new password</td>
                                <td class="para">new_password</td>
                                <td class="parameter">
                                    <input name="new_password" placeholder="required">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>new password</p></td>
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
                    <span class="name">update broadcast settings</span>
                    <span class="uri">/user/update_broadcast_settings</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/update_broadcast_settings" type="hidden">
                    <span class="description">It is used to change the user password. </span>
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
                                <td class="name">userid</td>
                                <td class="para">userid</td>
                                <td class="parameter">
                                    <input name="userid" placeholder="required">
                                </td>
                                <td class="type">numeric</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>user id</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">access_token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>access_token.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">is_notify</td>
                                <td class="para">is_notify</td>
                                <td class="parameter">
                                    <input name="is_notify" placeholder="optional">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>is_notify 0 or 1</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">is_private</td>
                                <td class="para">is_private</td>
                                <td class="parameter">
                                    <input name="is_private" placeholder="optional">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>is_private 0 or 1</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">is_auto_group_invite</td>
                                <td class="para">is_auto_group_invite</td>
                                <td class="parameter">
                                    <input name="is_auto_group_invite" placeholder="optional">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>is_auto_group_invite 0 or 1</p></td>
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
                    <span class="name">oauth api</span>
                    <span class="uri">/user/oauth</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/oauth" type="hidden">
                    <span class="description">It is used external appuser login or signup. </span>
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
                                <td class="name">auth_id</td>
                                <td class="para">auth_id</td>
                                <td class="parameter">
                                    <input name="auth_id" placeholder="required">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>auth_id</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">auth_type</td>
                                <td class="para">auth_type</td>
                                <td class="parameter">
                                    <input name="auth_type" placeholder="required">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>auth_type facebook or twitter or google</p></td>
                            </tr>
                             <tr class="required">
                                <td class="name">First Name</td>
                                <td class="para">first_name</td>
                                <td class="parameter">
                                    <input name="first_name" placeholder="optional">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>First Name.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Last Name</td>
                                <td class="para">last_name</td>
                                <td class="parameter">
                                    <input name="last_name" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Last Name</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">User Name</td>
                                <td class="para">username</td>
                                <td class="parameter">
                                    <input name="username" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Name.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Email</td>
                                <td class="para">email</td>
                                <td class="parameter">
                                    <input name="email" placeholder="optional">
                                </td>
                                <td class="type">email</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Email</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">State</td>
                                <td class="para">state</td>
                                <td class="parameter">
                                    <input name="state" placeholder="optional">
                                </td>
                                <td class="type">text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>State</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Country</td>
                                <td class="para">country</td>
                                <td class="parameter">
                                    <input name="country" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Country</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">ProfilePic</td>
                                <td class="para">profile_pic</td>
                                <td class="parameter">
                                    <input name="profile_pic" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Profile pic</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Device token</td>
                                <td class="para">device_token</td>
                                <td class="parameter">
                                    <input name="device_token" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Device token</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">device type</td>
                                <td class="para">device_type</td>
                                <td class="parameter">
                                    <input name="device_type" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Device type android or iphone</p></td>
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
                    <span class="description">It is used to user list. </span>
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
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">keyword</td>
                                <td class="para">keyword</td>
                                <td class="parameter">
                                    <input name="keyword" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>search by keyword</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">sort</td>
                                <td class="para">sort</td>
                                <td class="parameter">
                                    <input name="sort" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>(latest-1,trending-2)</p></td>
                            </tr>
                               <tr class="optional">
                                <td class="name">page_no</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>page_no</p></td>
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
                    <span class="name">Follow, Block and UnFollow</span>
                    <span class="uri">/user/follow_unfollow_block</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/follow_unfollow_block" type="hidden">
                    <span class="description">It is used to user follow unfollow and block. </span>
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
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">type</td>
                                <td class="para">type</td>
                                <td class="parameter">
                                    <input name="type" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>1-follow,2-block,3-unfollow</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">member id</td>
                                <td class="para">member_id</td>
                                <td class="parameter">
                                    <input name="member_id" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>member_id</p></td>
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
                    <span class="http-method">GET</span>
                    <span class="name">Block List</span>
                    <span class="uri">/user/block_list</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/block_list" type="hidden">
                    <span class="description">It is used to block list. </span>
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
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">page_no</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>page_no</p></td>
                            </tr>



                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>
        <!-- My Groups -->
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Get Mygroup lists</span>
                    <span class="uri">/broadcast/mygroup</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/broadcast/mygroup" type="hidden">
                    <span class="description">It is used to list the groups. </span>
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
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                             <tr class="optional">
                                <td class="name">Pag No</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Pag No (start from 1).</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>      
                        <div class="my_result"></div> 
                    </pre>
                </form>
            </li> 
            <!-- Add/edit Group -->
			<li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Add/Edit Group</span>
                    <span class="uri">/broadcast/aegroup</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/broadcast/aegroup" type="hidden">
                    <span class="description">It is used to add/edit group. </span>
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
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Group Name</td>
                                <td class="para">group_name</td>
                                <td class="parameter">
                                    <input name="group_name" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Group Name.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Type</td>
                                <td class="para">type</td>
                                <td class="parameter">
                                    <input name="type" placeholder="required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Type 1 - Followers, 2 - Users.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">User Ids</td>
                                <td class="para">user_ids</td>
                                <td class="parameter">
                                    <input name="user_ids" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User id (comma separated values)</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Group Id</td>
                                <td class="para">group_id</td>
                                <td class="parameter">
                                    <input name="group_id" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Group Id</p></td>
                            </tr> 
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>      
                        <div class="my_result"></div> 
                    </pre>
                </form>
            </li> 
             <!-- Delete Group -->
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Delete Group</span>
                    <span class="uri">/broadcast/degroup</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/broadcast/degroup" type="hidden">
                    <span class="description">It is used to delete group. </span>
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
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Group Id</td>
                                <td class="para">group_id</td>
                                <td class="parameter">
                                    <input name="group_id" placeholder="required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Group Id</p></td>
                            </tr> 
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>      
                        <div class="my_result"></div> 
                    </pre>
                </form>
            </li> 
             <!-- Mybroadcasts -->
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Get Mybroadcast lists</span>
                    <span class="uri">/broadcast/listing</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/broadcast/listing" type="hidden">
                    <span class="description">It is used to list the (Mybroadcast, Suggestion, Recent, Live, Featured, Group). </span>

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
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Member Id</td>
                                <td class="para">member_id</td>
                                <td class="parameter">
                                    <input name="member_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Member Id.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Type</td>
                                <td class="para">type</td>
                                <td class="parameter">
                                    <input name="type" placeholder="required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Type <br/>
                                 1 - Mybroadcast, 
                                 2 - Suggestion,
                                 3 - Recent,
                                 4 - Live,
                                 5 - Featured,
                                 6 - Group
                                .</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">keyword</td>
                                <td class="para">keyword</td>
                                <td class="parameter">
                                    <input name="keyword" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>keyword.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Broadcast Id</td>
                                <td class="para">broadcast_id</td>
                                <td class="parameter">
                                    <input name="broadcast_id" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Broadcast Id.</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Pag No</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Pag No (start from 1).</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>      
                        <div class="my_result"></div> 
                    </pre>
                </form>
            </li> 
            <!-- Add Broadcast -->
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Add Broadcast</span>
                    <span class="uri">/broadcast/aebroadcast</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/broadcast/aebroadcast" type="hidden">
                    <span class="description">It is used to add broadcast. </span>
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
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Latitude</td>
                                <td class="para">lat</td>
                                <td class="parameter">
                                    <input name="lat" placeholder="required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Latitude</p></td>
                            </tr>
                             <tr class="required">
                                <td class="name">Longitude</td>
                                <td class="para">long</td>
                                <td class="parameter">
                                    <input name="long" placeholder="required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Longitude</p></td>
                            </tr>
                             <tr class="required">
                                <td class="name">Type</td>
                                <td class="para">type</td>
                                <td class="parameter">
                                    <input name="type" placeholder="required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Type(public,group,users)</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Broadcast Name</td>
                                <td class="para">broadcast_name</td>
                                <td class="parameter">
                                    <input name="broadcast_name" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Broadcast Name</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Invite Users</td>
                                <td class="para">invite_user_id</td>
                                <td class="parameter">
                                    <input name="invite_user_id" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Invite Users (comma separated values)</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Group Id</td>
                                <td class="para">group_id</td>
                                <td class="parameter">
                                    <input name="group_id" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Group Id</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>      
                        <div class="my_result"></div> 
                    </pre>
                </form>
            </li>
            <!-- Broadcast Action -->
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Broadcast Action</span>
                    <span class="uri">/broadcast/actionbt</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/broadcast/actionbt" type="hidden">
                    <span class="description">It is used to perform following actions (Delete, stop, is_live, like, comments, views) in broadcast. </span>
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
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Broadcast Id</td>
                                <td class="para">broadcast_id</td>
                                <td class="parameter">
                                    <input name="broadcast_id" placeholder="required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Broadcast Id</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Action Type</td>
                                <td class="para">action_type</td>
                                <td class="parameter">
                                    <input name="action_type" placeholder="required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>1-Delete, 2-stop, 3-is_live, 4-like, 5-comments, 6-views</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Description</td>
                                <td class="para">cmt_desc</td>
                                <td class="parameter">
                                    <input name="cmt_desc" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Comment Description (slash ### separated values)</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Like</td>
                                <td class="para">like_count</td>
                                <td class="parameter">
                                    <input name="like_count" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Like Count</p></td>
                            </tr>
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>      
                        <div class="my_result"></div> 
                    </pre>
                </form>
            </li>
             <!-- Recently Watched API -->
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Get Myrecently Watched Broadcast</span>
                    <span class="uri">/broadcast/myrecentbt</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/broadcast/myrecentbt" type="hidden">
                    <span class="description">It is used to list the recently watched broadcast. </span>
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
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                             <tr class="optional">
                                <td class="name">Pag No</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Pag No (start from 1).</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>      
                        <div class="my_result"></div> 
                    </pre>
                </form>
            </li>

             <!-- Recently Watched API -->
            <li class="method get">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name"> FileUpload</span>
                    <span class="uri">/fileupload</span>
                </div>
                <form class="hidden" style="display: block;" enctype="multipart/form-data" id="multipart">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/fileupload" type="hidden">
                    <span class="description">It is used to list the recently watched broadcast. </span>
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
                                <td class="name">File</td>
                                <td class="para">file</td>
                                <td class="parameter">
                                    <input type="file" name="file" id="file" />
                                    <!-- <input name="cimage" placeholder="required"> -->
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>File</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">type</td>
                                <td class="para">type</td>
                                <td class="parameter">
                                    <input name="type" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Type.</p></td>
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
                    <span class="name">Following list</span>
                    <span class="uri">/user/following_list</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/following_list" type="hidden">
                    <span class="description">It is used to list following persons. </span>
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
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                              <tr class="required">
                                <td class="name">Page no</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page no</p></td>
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
                    <span class="name">Followers list</span>
                    <span class="uri">/user/followers_list</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/followers_list" type="hidden">
                    <span class="description">It is used to list followers persons. </span>
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
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr>
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr>
                              <tr class="required">
                                <td class="name">Page no</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page no</p></td>
                            </tr>
                            
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>
                        <div class="my_result"></div>
                    </pre>
                </form>
            </li>

                        <!-- Delete User-->
<!-- Group Delete -->
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Group Delete</span>
                    <span class="uri">/broadcast/group_delete</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/broadcast/group_delete" type="hidden">
                    <span class="description">It is used for group delete. </span>
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
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Group Id</td>
                                <td class="para">group_id</td>
                                <td class="parameter">
                                    <input name="group_id" placeholder="required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Group Id (comma separated values)</p></td>
                            </tr> 
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>      
                        <div class="my_result"></div> 
                    </pre>
                </form>
            </li> 
            <!-- Broadcast Group Delete -->
             <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Broadcast Group Delete</span>
                    <span class="uri">/broadcast/broadcast_group_delete</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/broadcast/broadcast_group_delete" type="hidden">
                    <span class="description">It is used for broadcast group delete. </span>
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
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Broadcast Id</td>
                                <td class="para">broadcast_id</td>
                                <td class="parameter">
                                    <input name="broadcast_id" placeholder="required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Broadcast Id (comma separated values)</p></td>
                            </tr> 
                        </tbody>
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
                    <span class="description">It is used to delete the user. </span>
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
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Delete Id</td>
                                <td class="para">u_id</td>
                                <td class="parameter">
                                    <input name="u_id" placeholder="required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Delete Id</p></td>
                            </tr> 
                        </tbody>
                    </table>
                    <input value="Try it!" type="submit">

                    <pre>      
                        <div class="my_result"></div> 
                    </pre>
                </form>
            </li> 

            <!-- Group Delete -->

            <!-- checkfor notify -->
            <li class="method post">
                <div class="title">
                    <span class="http-method">POST</span>
                    <span class="name">Notification</span>
                    <span class="uri">/user/notification</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="POST" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/user/notification" type="hidden">
                    <span class="description">It is used to receieving notifications. </span>
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
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr> 
                           <tr class="required">
                                <td class="name">Page no</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Page no</p></td>
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
                    <span class="description">It is used for sending an email. </span>
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
                                    <input name="user_id" placeholder="required">
                                </td>
                                <td class="type">Id</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>User Id.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Access Token</td>
                                <td class="para">access_token</td>
                                <td class="parameter">
                                    <input name="access_token" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Access Token.</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Member Id</td>
                                <td class="para">member_id</td>
                                <td class="parameter">
                                    <input name="member_id" placeholder="required">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Member Id</p></td>
                            </tr> 
                            <tr class="optional">
                                <td class="name">Email Id</td>
                                <td class="para">email_id</td>
                                <td class="parameter">
                                    <input name="email_id" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Email Id</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Subject</td>
                                <td class="para">subject</td>
                                <td class="parameter">
                                    <input name="subject" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Subject</p></td>
                            </tr> 
                            <tr class="required">
                                <td class="name">Message</td>
                                <td class="para">message</td>
                                <td class="parameter">
                                    <input name="message" placeholder="required">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Message</p></td>
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
                    <span class="name">Home Page Listing</span>
                    <span class="uri">/broadcast/home</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/broadcast/home" type="hidden">
                    <span class="description">It is used to list the broadcasts. </span>
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
                            <tr class="optional">
                                <td class="name">Keyword</td>
                                <td class="para">keyword</td>
                                <td class="parameter">
                                    <input name="keyword" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>search by keyword</p></td>
                            </tr>
                            <tr class="optional">
                                <td class="name">Hashtag</td>
                                <td class="para">hashtag</td>
                                <td class="parameter">
                                    <input name="hashtag" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>search by hashtag</p></td>
                            </tr>
                             <tr class="optional">
                                <td class="name">Pag No</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Pag No (start from 1).</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>      
                        <div class="my_result"></div> 
                    </pre>
                </form>
            </li>   

            <!-- Channel listing -->
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Channel Listing</span>
                    <span class="uri">/broadcast/channels</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/broadcast/channels" type="hidden">
                    <span class="description">It is used to list the channels. </span>
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
                             <tr class="optional">
                                <td class="name">Pag No</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Pag No (start from 1).</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>      
                        <div class="my_result"></div> 
                    </pre>
                </form>
            </li> 

            <!-- Suggested listing -->
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Suggested Listing</span>
                    <span class="uri">/broadcast/suggested</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/broadcast/suggested" type="hidden">
                    <span class="description">It is used to list the suggested. </span>
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
                             <tr class="optional">
                                <td class="name">Pag No</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Pag No (start from 1).</p></td>
                            </tr>
                        </tbody>

                    </table>
                    <input value="Try it!" type="submit">

                    <pre>      
                        <div class="my_result"></div> 
                    </pre>
                </form>
            </li> 

            <!-- Complted listing -->
            <li class="method get">
                <div class="title">
                    <span class="http-method">GET</span>
                    <span class="name">Broadcast Listing</span>
                    <span class="uri">/broadcast/completed</span>
                </div>
                <form class="hidden" style="display: block;">
                    <input name="httpMethod" value="GET" type="hidden">
                    <input name="oauth" value="" type="hidden">
                    <input name="methodUri" value="/broadcast/completed" type="hidden">
                    <span class="description">It is used to list the completed. </span>
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
                             <tr class="optional">
                                <td class="name">Pag No</td>
                                <td class="para">page_no</td>
                                <td class="parameter">
                                    <input name="page_no" placeholder="optional">
                                </td>
                                <td class="type">Number</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Pag No (start from 1).</p></td>
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

<script src="<?php echo URL::asset('bsetec/js/common.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
  
$(document).ready(function() {
    
    $('form').on('submit', function() {
        var datatype = $(this).attr('id');
        //if($(this).attr('id')!='multipart'){
        var form = $(this);
    
        var methodtype = $(this).children('input[name=httpMethod]').val();
        
        var methoduri = $(this).children('input[name=methodUri]').val();
        $("#message").html("<span class='error'>API Request</span>");
        
        var siteurl = "<?php echo url(); ?>";
        
        var realpath = siteurl + methoduri;
        if (methodtype == 'DELETE') 
        {
            realpath = realpath + '?' + $(this).serialize();
        }
        if(datatype !='multipart' && datatype !='qtn_multipart'){
               $.ajax({
                type: methodtype, 
                url: realpath, // proper url to your "store-address.php" file
                data: $(this).serialize(),
                success: function(msg) 
                {
                    var msg1 = JSON.stringify(msg);
                    // $('#my_result' ).text(msg1);
                    form.find('.my_result').text(msg1);
                },
                error: function(msg)
                {
                    var msg1 = JSON.stringify(msg);
                    // $('#my_result' ).text(msg1);
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
        
        var siteurl = "<?php echo url(); ?>";
        
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
           var msg1 = JSON.stringify(msg);
           
            //var msg1 = msg;
            form.find('.my_result').text(msg1);
        },
         error: function(msg) 
         {
            //alert(msg);
            var msg1 = JSON.stringify(msg);
            //var msg1 = msg;
            form.find('.my_result').text(msg1);   
         }          
        });
    }); 
    $("#multiform").submit();

    ///qtn_multipart data submit
    $("#qtn_multipart").submit(function(e)
    {
        var form = $(this);
        var methodtype = $(this).children('input[name=httpMethod]').val();
        var methoduri = $(this).children('input[name=methodUri]').val();
        $("#message").html("<span class='error'>API Request</span>");
        
        var siteurl = "<?php echo url(); ?>";
        
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
           var msg1 = JSON.stringify(msg);
           
            //var msg1 = msg;
            form.find('.my_result').text(msg1);
        },
         error: function(msg) 
         {
            //alert(msg);
            var msg1 = JSON.stringify(msg);
            //var msg1 = msg;
            form.find('.my_result').text(msg1);   
         }          
        });
    }); 
});
</script>
</body>
</html>

