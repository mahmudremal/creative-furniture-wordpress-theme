document.addEventListener("DOMContentLoaded", function () {
  const reviewList = document.querySelector("#product-review-list");
  const searchInput = document.querySelector('input[name="keyword"]');
  const sortSelect = document.querySelector('select[name="sortby"]');
  const ratingSelect = document.querySelector('select[name="rating"]');
  const productId = cf_reviews_obj.product_id;

  let timeout = null;

  const fetchReviews = () => {
    const formData = new FormData();
    formData.append("action", "filter_reviews");
    formData.append("nonce", cf_reviews_obj.nonce);
    formData.append("product_id", productId);
    formData.append("keyword", searchInput.value);
    formData.append("sortby", sortSelect.value);
    formData.append("rating", ratingSelect.value);

    reviewList.style.opacity = "0.5";

    fetch(cf_reviews_obj.ajax_url, {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          reviewList.innerHTML = data.data;
        }
        reviewList.style.opacity = "1";
      })
      .catch((error) => {
        console.error("Error fetching reviews:", error);
        reviewList.style.opacity = "1";
      });
  };

  searchInput.addEventListener("keyup", () => {
    clearTimeout(timeout);
    timeout = setTimeout(fetchReviews, 500);
  });

  sortSelect.addEventListener("change", fetchReviews);
  ratingSelect.addEventListener("change", fetchReviews);
});
