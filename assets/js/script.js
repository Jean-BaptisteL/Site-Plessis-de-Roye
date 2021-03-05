let list = document.getElementsByClassName("updateArticleBtn"), li = list.length, i, idArticle, pathArticle, titleArticle, typeArticle;
let list2 = document.getElementsByClassName("deleteArticleBtn"), idDeleteArticle, pathDeleteArticle;
let listmember = document.getElementsByClassName("updateMemberBtn"), idMember, photoPath, memberFirstname, memberLastname, memberJob, liM = listmember.length;
let listmember2 = document.getElementsByClassName("deleteMemberBtn"), idDeleteMember, pathDeleteMember;
let listUpdateEvent = document.getElementsByClassName("updateEventBtn"), idEvent, topicEvent, descriptionEvent, dateEvent, liE = listUpdateEvent.length;
let listDeleteEvent = document.getElementsByClassName("deleteEventBtn"), idDeleteEvent;
let listUpdateBooking = document.getElementsByClassName("updateBookingBtn"), idBooking, startDateBooking, endDateBooking, nameBooking, liB = listUpdateBooking.length;
let listDeleteBooking = document.getElementsByClassName("deleteBookingBtn"), idDeleteBooking;
for (i = 0; i < li; i++) {
    list[i].addEventListener("click", function () {
        idArticle = this.getAttribute("data-id");
        pathArticle = this.getAttribute("data-path");
        titleArticle = this.getAttribute("data-title");
        typeArticle = this.getAttribute("data-type");
        document.getElementById("articleId").value = idArticle;
        document.getElementById("articlePath").value = pathArticle;
        document.getElementById("newTitleFile").value = titleArticle;
        document.getElementById("newLocationFile").value = typeArticle;
    });
}
for (i = 0; i < liM; i++) {
    listmember[i].addEventListener("click", function () {
        idMember = this.getAttribute("data-id");
        photoPath = this.getAttribute("data-path");
        memberFirstname = this.getAttribute("data-firstname");
        memberLastname = this.getAttribute("data-lastname");
        memberJob = this.getAttribute("data-job");
        document.getElementById("memberId").value = idMember;
        document.getElementById("oldPath").value = photoPath;
        document.getElementById("counsilMemberNewFirstname").value = memberFirstname;
        document.getElementById("counsilMemberNewLastname").value = memberLastname;
        document.getElementById("counsilMemberNewJob").value = memberJob;
    });
    listmember2[i].addEventListener("click", function () {
        idDeleteMember = this.getAttribute("data-id");
        pathDeleteMember = this.getAttribute("data-path");
        document.getElementById("deleteMemberId").value = idDeleteMember;
        document.getElementById("deleteMemberPath").value = pathDeleteMember;
    });
}
for (i = 0; i < liE; i++) {
    listUpdateEvent[i].addEventListener("click", function () {
        idEvent = this.getAttribute("data-id");
        topicEvent = this.getAttribute("data-topic");
        descriptionEvent = this.getAttribute("data-description");
        dateEvent = this.getAttribute("data-date");
        document.getElementById("eventId").value = idEvent;
        document.getElementById("eventNewTopic").value = topicEvent;
        document.getElementById("eventNewDescription").value = descriptionEvent;
        document.getElementById("eventNewDate").value = dateEvent;
    });
    listDeleteEvent[i].addEventListener("click", function (){
        idDeleteEvent = this.getAttribute("data-id");
        document.getElementById("deleteEventId").value = idDeleteEvent;
    });
}
for (i = 0; i < li; i++) {
    list2[i].addEventListener("click", function () {
        idDeleteArticle = this.getAttribute("data-id");
        pathDeleteArticle = this.getAttribute("data-path");
        document.getElementById("deleteArticleId").value = idDeleteArticle;
        document.getElementById("deleteArticlePath").value = pathDeleteArticle;
    });
}
for (i = 0; i < liB; i++) {
    listUpdateBooking[i].addEventListener("click", function () {
        idBooking = this.getAttribute("data-id");
        startDateBooking = this.getAttribute("data-startDate");
        endDateBooking = this.getAttribute("data-endDate");
        nameBooking = this.getAttribute("data-name");
        document.getElementById("bookingId").value = idBooking;
        document.getElementById("newStartDate").value = startDateBooking;
        document.getElementById("newEndDate").value = endDateBooking;
        document.getElementById("newName").value = nameBooking;
    });
    listDeleteBooking[i].addEventListener("click", function (){
        idDeleteBooking = this.getAttribute("data-id");
        document.getElementById("deleteBookingId").value = idDeleteBooking;
    });
}
