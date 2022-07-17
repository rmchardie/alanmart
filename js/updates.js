const postsContainer = document.querySelector(".posts-container");
let postLinkContainer;
const postLinkText = "";

function showPosts() {
  // Display contents of JSON file
  fetch("./posts.json")
    .then((response) => response.json())
    // parsed contains the parsed JSON file
    .then((parsed) => {
      if (parsed.length != 0) {
        parsed.forEach((post) => {
          if (post.postImage === "") {
            post.postImage = "logo.png";
          }

          // Create div for each post item
          const postItem = document.createElement("div");
          const postImageContainer = document.createElement("div");
          const postImage = document.createElement("img");
          const postDate = document.createElement("div");
          const postTitle = document.createElement("div");
          const postTitleText = document.createElement("div");
          const postContent = document.createElement("div");
          postLinkContainer = document.createElement("div");
          const postLink = document.createElement("a");
          const postLinkElementText = document.createTextNode(post.postLink);
          const postDivider = document.createElement("hr");

          // Add class name to each div
          postItem.classList.add("postItem");
          postImageContainer.classList.add("postImageContainer");
          postLinkContainer.classList.add("postLinkContainer");
          postDate.classList.add("postDate");
          postTitle.classList.add("postTitle");
          postTitleText.classList.add("postTitleText");
          postContent.classList.add("postContent");
          postDivider.classList.add("postDivider");

          // Set attributes of each div / image
          postImage.setAttribute("src", `images/${post.postImage}`);
          postImage.setAttribute("alt", `${post.postTitle} image`);
          postDate.textContent = post.postDate;
          postTitleText.textContent = post.postTitle;
          postContent.innerText = post.postContent;
          postLink.setAttribute("href", post.postLink);

          // Add div to parent container
          postLink.appendChild(postLinkElementText);
          postsContainer.appendChild(postItem);
          postsContainer.appendChild(postDivider);
          postItem.appendChild(postImageContainer);
          postLinkContainer.appendChild(postLink);
          postImageContainer.appendChild(postImage);
          postItem.appendChild(postTitle);
          postTitle.appendChild(postDate);
          postTitle.appendChild(postTitleText);
          postTitle.appendChild(postContent);
          postContent.appendChild(postLinkContainer);
        });
      } else {
        postsContainer.style.textAlign = "center";
        postsContainer.style.fontSize = "32px";
        postsContainer.style.padding = "20px 0 0 20px";
        postsContainer.textContent =
          "There are currently no updates to display.";
      }
    });
}

showPosts();
