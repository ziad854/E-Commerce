const validation = new JustValidate("#RegForm");
validation
    .addField("#Email", [
        { rule: "required" }, { rule: "email" } 
    ])
    .addField("#Username", [
        { rule: "required" }
    ])
    .addField("#Password", [
        { rule: "required" }, { rule: "password" }
    ])
    .onSuccess((event) => {
        document.getElementById("RegForm").submit();     //to execute
    });