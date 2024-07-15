<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
              <div id="calendar"></div>

              <script>
                $(document).ready(function() {
                  var calendarEl = document.getElementById('calendar');
                  var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    locale: 'fr', // Pour afficher le calendrier en français
                    headerToolbar: {
                      left: 'prev,next today',
                      center: 'title',
                      right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    events: [
                      {
                        title: 'Événement 1',
                        start: '2024-07-10',
                        end: '2024-07-12'
                      },
                      {
                        title: 'Événement 2',
                        start: '2024-07-15',
                        allDay: true
                      }
                    ]
                  });
                  calendar.render();
                });
              </script>
            </div>
        </div>
    </div>