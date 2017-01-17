<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport"
				content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="css/style.css">
		<title>ProductHunt Ownership Post Data Design</title>
	</head>
	<body>
		<header>
			<h1>Persona, Use Case, Interaction Flow, and Conceptual Model</h1>
		</header>
		<main>
			<h2>Persona</h2>
			<p><span>Name:</span> Rafael</p>
			<p><span>Age:</span> 24</p>
			<p><span>Gender:</span> Male</p>
			<p><span>Occupation:</span> Entrepreneur</p>
			<p><span>Technology:</span> iPhone 7 & Macbook Pro running OS X Sierra (which he is using to post his app on ProductHunt)</p>
			<p><span>Needs:</span> Web developer and entrepreneur who is using ProductHunt as a way to get the word out about his fledgling web app, in hopes that his web app will get enough attention to be highlighted on the front page and in ProductHunt's daily e-mail to thousands upon thousands of e-mail subscribers. Without a marketing budget Rafael knows that social proof on ProductHunt is a major milestone that needs to be accomplished for his new app to grow rapidly without spending money on advertising.</p>
			<p><span>Goals:</span> Rafael has been actively participating on ProductHunt the entire time he has been creating his app MVP. He knows that having an established reputation and some solid connections on PH will help his app get in front of more eyes than it would without actively participating, because he knows that PH is a tight knit community of like-minded makers, entrepreneurs and developers. He also is constantly on the lookout for apps similar to his own to compare features and read feedback from community members.</p>
			<h2>Use Case</h2>
			<p>Rafael needs to let the ProductHunt community know that he is ready to show the world his app MVP and to get their feedback to enhance his app. He logs into PH and clicks on the + in the upper right corner. He enters his apps URL manually, because he's typed it into his Chrome browser too many times to count, and hits the 'next' button. On the next page of the form Rafael types in the name of his app, '<span>Spin the Digital Bottle</span>'. He presses tab to move to the next field and enters his tagline, '<span>The digital bottle everyone is dying to spin. Who will you land on next?</span>'. He then chooses the 'Games' drop down menu item for the category of his app. Rafael really wants to be visible to all the PH users, so he's already planned out what topic tags he will use, based on his interaction on PH the past few months. He enters, '<span>digital makeout session, teenage angst games, If only I got to play REAL spin the bottle with Karen *tear*...</span>'. Rafael then sets the status of his post to 'Available Now' and clicks the 'next' button. Rafael then uploads a thumbnail image from his computer, and a few gallery screen shots to showcase all the best features of his app. He then clicks the 'next' button once again. Finally, on the last page of the form, Rafael enters his ProductHunt handle to the 'Makers' form field to make it official, and then quickly clicks the 'submit' button with a sigh of relief.</p>
			<h2>Interaction Flow</h2>
			<ol>
				<li>open producthunt.com in web browser</li>
				<li>login to website</li>
				<li>click + button in upper right corner</li>
				<li>type in the URL of web app into form field</li>
				<li>click next button</li>
				<li>type in the name of app</li>
				<li>type in the tagline of app, not to exceed 60 chars</li>
				<li>choose category from drop down menu</li>
				<li>type in topics related to app</li>
				<li>choose status of app</li>
				<li>click next button</li>
				<li>click on upload an image link and choose thumbnail image from local computer</li>
				<li>click upload an image link and choose one or more gallery images from local computer</li>
				<li>click on submit button</li>
			</ol>
			<h2>Conceptual Model</h2>
			<ul>
				<li>One user can have many posts</li>
				<li>One post can have one owner</li>
				<li>One post can have many makers</li>
				<li>One post can have many images</li>
				<li>One post can have one thumbnail image</li>
				<li>One post can have many topics</li>
				<li>One post can have one category</li>
			</ul>
			<h2>Entities & Relationships</h2>
			<table>
				<tr>
					<th>Profile</th>
					<th>Post</th>
				</tr>
				<tr>
					<td>profileId</td>
					<td>postId</td>
				</tr>
				<tr>
					<td>profileEmail</td>
					<td>postProfileId</td>
				</tr>
				<tr>
					<td>profileFirstName</td>
					<td>postURL</td>
				</tr>
				<tr>
					<td>profileLastName</td>
					<td>postProductName</td>
				</tr>
				<tr>
					<td>profileAvatarImage</td>
					<td>postThumbnailImage</td>
				</tr>
				<tr>
					<td>profileCreatedTimestamp</td>
					<td>postCreatedTimestamp</td>
				</tr>
				<tr>
					<td></td>
					<td>postGalleryImage</td>
				</tr>
			</table>
			<img src="images/producthunt-ownership-post.svg" alt="ERD diagram for DDL project">
		</main>
	</body>
</html>