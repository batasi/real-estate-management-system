function getBotResponse(input) {
    if (input == "hello") {
        return "Hello there!";
    } else if (input == "goodbye") {
        return "Talk to you later!";
    } else if (input == "where is the contact") {
        return "Do not worry, visit the contact page!";
    }
    else if (input == "yes") {
        return "Respond with the options <br>1.Property Listings<br> 2.Contact Us<br> 3.Our Services<br> 4.About Us";
    } else if (input == "1") {
        return "To visit our property listings click on the heart button below";
    } 
    else if (input == "2") {
        return "Sure! Hit the send button below to Contact us";
    }
    else if (input == "3"){
        return "To Know our services hit the spoon button below!";
    }
    else if (input == "4"){
        return "To Know more about Us hit the plane button below!!";
    }
    else if (input == "5"){
        return "Why did the manager bring a ladder to work?<br>  Because he wanted to reach new heights!";
    }
    else if (input == "no"){
        return "Reply 5 for a joke";
    }
    else{
        return "Try asking something else! Maybe type 5 for a joke";
    }
}