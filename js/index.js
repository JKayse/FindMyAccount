
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
    
    email = JSON.stringify(emailArray);
    username = JSON.stringify(usernameArray);
    $("body").addClass("clicked");

    $.ajax({
            type: "POST",
            //url: "api/CreateEvent",
            data: {
                emails: email,
                usernames: username
            },
            success: function(json){         
                $(".email").val("");
                $(".username").val("");
                $("#resultsList").empty();
                json = JSON.parse(json);
                if(json.length === 0){
                    $("#resultsList").append("<h3>No Results Found.</h3>");
                    $("#results").show();
                    return;

                }

                $.each(json, function( index, value ) {
                    var resultItem = "";
                    var name = value.name;
                    var description = value.description;
                    var imageLink = value.imageLink;
                    var webSiteLink = value.webSiteLink;
                    var emailUsed = value.emailUsed;
                    var usernameUsed = value.usernameUsed;

                    resultItem = "<li><h3 class='name'>" + name +
                        "</h3><img src='" + imageLink +
                        "' class='companyLogo' alt='Logo' title='Logo'><p class='description'>" +
                        description + "</p><a href='" + webSiteLink +
                        "' class='companyUrl'>Link to " + name + "</a><h4 class='emailUsed'>Email:" + emailUsed + "</h4>";
                    if(usernameUsed === NULL){
                        resultItem = resultItem + "<h4 class='usernameUsed'>Username:" + usernameUsed +"</h4>";
                    }
                    resultItem = resultItem + "</li>";
                    $("#resultsList").append(resultItem);
                    $("#results").show();
                  
                });


            }
    });

}
