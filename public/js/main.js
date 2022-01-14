window.onload = () => {
    let calendarElt = document.querySelector("#calendar");
    console.log(data)

    var events = []; 
    for(var i =0; i < data.length; i++) 
    {events.push( {title: "Réservé" , start: data[i]["debutContrat"], end: data[i]["finContrat"]})}
    console.log(events);

    let calendar = new FullCalendar.Calendar(calendarElt, {
        initialView: 'dayGridMonth',
        locale: 'fr',
        timeZone: 'Europe/Paris',
        headerToolbar: {
            start:'prev,next today',
            center: 'title',
            end: 'dayGridMonth, timeGridWeek'
        },
        events: events
    });

    calendar.render();
}