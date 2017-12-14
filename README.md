# COMP310P_GroupJ
COMP310P - Web development repository 
This repository will be used by GroupJ to collaborate on a group project. 
Hi my name is Kwaku Owusu-Ansah & I go to UCL. 
Hi my name is Danielle and I study Mechanical Engineering at UCL
Hi my name is Jenny and I'm taking Web Development at UCL.


We have decided to do an event management system for Musical Concert events.



 


******* THINGS TO DO *********

User pages
1) Finish User Profile Page - Kwaku (user show) ----> DONE
2) Create - Host Profile page - Kwaku () --->   DONE
3) Add page showing MY BOOKINGS (events I've booked to)

Booking pages
**COMPLETE** booking confirmation page - add php links to get their email and booking ID to display
4) Make a booking page - update after events are finished

About us/contact us
5) place stylesheet links in header file

Event pages
6) **COMPLETE** event show page - php queries to display events
7) event ratings page - see 'event show page', also store their ratings


Query Functions to write: 

**COMPLETE**
*function find_booking_by_id($id) {
*function validate_booking($booking) {
*function insert_booking($booking) {
*function update_booking($booking) {
*function delete_booking($booking_id) {

function find_rating_by_id($id) {
function validate_rating($booking) {
function insert_rating($booking) {
function update_rating($booking) {
function delete_rating($booking_id) {


WIRE FRAME CHECKLIST
To Do:
What's On - Only show future events & Styling & add image link 
Locations - Looks liek whats on page and columns are different and have pictures
Profile page = users/show.php - need styling & host rating details and review details
Header - profile link & create event
Create event & profile.




Extras
What's On - add image link 
About Us - Add Team Photo
Header -  create event redirect to sign in redirect to create event
User page - host details on profile? or sep page?
search results - tick box filter



**** Questions for TA ****************
1) How do I create a dropdown list showing countries and cities where cities shown depend on country chosen
2) How the hell are we going to add  cookie??
3) 


do we have to alert that email sent
3) Create - Booking page
4) Create - booking confirmation page
5) Create- create event page
6) Create Event page
7) Change search bar.

Header
1) Change class(header.php) to active for current page
2) Add log-out button functionality using if statements 



--------------------------------------------------------------------------------
COURSEWORK REQUIREMENTS
--------------------------------------------------------------------------------
1.
--------------------------------------------------------------------------------
All users can register with the system and create an account. A user must log in to the system
before using it. A user can be a host and may set up their own events. A user can also be a
participant and book tickets to other people’s events.
2. A user may create an event, setting suitable conditions and features of the event including the
description, location, date, categorisation, number of tickets available and end date.
3. A user can search the system for categories of events and can browse events within certain
categories or timeframes.
4. A user can book a ticket for an event. The system will manage the ticket sales until the set end
time. No further ticket sales will be permitted if the event is full or if the end time for ticket sales
of that event has been reached.
5 Participants can view a list of events they are attending and receive emailed updates on events
that are imminent. You only have to show that an event (creating an email message) can be
triggered at the date and time, you do not need to implement an email system.
6. Users hosting events can view the progress of ticket sales and generate a list of participants for
an event.
7. Participants can give feedback and ratings on events after they have happened. Ratings and
feedback are visible to other users.
