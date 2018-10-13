<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="icon" href="<?php echo URL::asset('images/favicon.ico');; ?>" type="image/x-icon">
<script src="<?php echo URL::asset('bsetec/js/jquery.v1.8.2.js');; ?>" type="text/javascript"></script>
<link href="<?php echo URL::asset('bsetec/css/api_docstyles.css');; ?>" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Instaplus API</title>

<script type="text/javascript">
    $.ajaxSetup({
       headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
</script>
</head>
<body>
<h1 id="title">Instaplus API v1.1 Resources</h1>
<div id="controls">
    <ul>
        <li><a id="toggle-endpoints" href="#">Toggle All Endpoints</a></li>
        <li><a id="toggle-methods" href="#">Toggle All Methods</a></li>
    </ul>
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
                            <tr class="optional">
                                <td class="name">Language</td>
                                <td class="para">language</td>
                                <td class="parameter">
                                    <input name="language" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Preferred Language for user. Use[en, id, ar, fr, de]</p></td>
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
                            <tr class="optional">
                                <td class="name">Language</td>
                                <td class="para">language</td>
                                <td class="parameter">
                                    <input name="language" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Preferred Language for user. Use[en, id, ar, fr, de]</p></td>
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
                             <tr class="optional">
                                <td class="name">Language</td>
                                <td class="para">language</td>
                                <td class="parameter">
                                    <input name="language" placeholder="optional">
                                </td>
                                <td class="type">Text</td>
                                <td class="location"><p>query</p></td>
                                <td class="description"><p>Preferred Language for user. Use[en, id, ar, fr, de]</p></td>
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

