
function displayImg1()
{
document.getElementById("centralimg").src="css/images/vasco-rossi.jpg";
}

function displayImg2()
{
document.getElementById("centralimg").src="css/images/Laura-Pausini-2.png";
}

function displayImg3()
{
document.getElementById("centralimg").src="css/images/aida.jpg";
}

function displayImgDefault()
{
	document.getElementById("centralimg").src="css/images/pic02.jpg";
}

function currentPage()
{
	$("li.current_page_item").removeClass("current_page_item");
	
}
