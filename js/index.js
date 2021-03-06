
$(document).ready(function() {
    $(document).on('submit', "#searchForm", getResults);
    $(document).on('click', "#addMoreUsernameFields", addMoreUsernameFields);
    $(document).on('click', "#addMoreEmailFields", addMoreEmailFields);


});


function addMoreEmailFields() {
    var insert = "<input type='email' class='email' placeholder='Email' name='email' title='Enter an email.'><br>";
    $(".email").last().next().after(insert);
}

function addMoreUsernameFields() {
    var insert = "<input type='text' class='username' placeholder='Username' name='username' title ='Enter a username.'><br>";
    $(".username").last().next().after(insert);
}

function getResults(event) {
    event.preventDefault();
    $("#loadingIcon").show();
    $("#results").hide();
    var emails = $(".email");
    var usernames = $(".username");
    var emailArray = [];
    var usernameArray = [];



    for(var i = 0; i < emails.size() ; i++){
        if(emails.eq(i).val() !== ""){
            var value = emails.eq(i).val();
            emailArray.push(value);
        }
    }

    for(var i = 0; i < usernames.size() ; i++){
        if(usernames.eq(i).val() !== ""){
            var value = usernames.eq(i).val();
            usernameArray.push(value);
        }
        
    }
    
    if(emailArray.length === 0 && usernameArray.length === 0){
        $("#loadingIcon").hide();
        alert("Please enter at least one username or email.");
        return;
    }

    email = (emailArray);
    username = (usernameArray);
    
    $("body").addClass("clicked");

    $.ajax({
            type: "POST",
            url: "feed.php",
            data: {
                emails: email,
                usernames: username
            },
            success: function(json){   

                
            	console.log(json);      
                $("#resultsList").empty();
                json = JSON.parse(json);
                
                if((json).length === 0){
                    $("#resultsList").append("<h3>No Results Found.</h3>");
                    $("#results").show();
                    $("#loadingIcon").hide();
                    return;
                }


                $.each(json, function( index, value ) {
                    var resultItem = "";
                    var name = value.name;
                    var description = value.description;
                    var imageLink = value.imgURL;
                    var webSiteLink = value.link;
                    var emailUsed = value.email;
                    var usernameUsed = value.username;
                    console.log(usernameUsed);

                    resultItem = "<li><h3 class='name'>" + name +
                        "</h3><img src='" + imageLink +
                        "' class='companyLogo' alt='Logo' title='Logo'><p class='description'>" +
                        description + "</p><a href='" + webSiteLink +
                        "' class='companyUrl'>Link to " + name + "</a>";
                    
                    if(emailUsed !== null){
                        resultItem = resultItem + "<h4 class='emailUsed'>Email:" + emailUsed + "</h4>";
                    }
                    if(usernameUsed !== null){
                        resultItem = resultItem + "<h4 class='usernameUsed'>Username:" + usernameUsed +"</h4>";
                    }
                    resultItem = resultItem + "</li>";
                    $("#resultsList").append(resultItem);
                    $("#results").show();
                    $("#loadingIcon").hide();
                  
                });


            }
    });

}
