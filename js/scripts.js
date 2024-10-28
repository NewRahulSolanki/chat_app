// js/scripts.js
let page = 1;

function loadPosts() {
  const loadingDiv = document.getElementById("loading");
  loadingDiv.style.display = "block";

  fetch(`load_posts.php?page=${page}`)
    .then((response) => response.text())
    .then((data) => {
      document.getElementById("posts").innerHTML += data;
      loadingDiv.style.display = "none";
      page++;
    })
    .catch((error) => {
      console.error("Error loading posts:", error);
      loadingDiv.style.display = "none";
    });
}

window.addEventListener("scroll", () => {
  if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
    loadPosts();
  }
});

document.addEventListener("DOMContentLoaded", loadPosts);
