<div class="categories">
    <h2>Categories</h2>
  @foreach ($categories as $category)
    <div class="categoryCard">
      <a href={{"/search?query=&category=" . $category->id}}>
        <div class="category-image">
          <img src="{{ asset($category['images']) }}" title="View" class="hover-effect" />
          <p>{{ $category->name }}</p>
        </div>
      </a>
    </div>
  @endforeach
</div>

<style>
  .categories {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
    margin: 1em 3em;
    padding: 1em ;
    border-radius: 5px;
    background-color: rgb(235, 235, 235);
  }
  .categories h2{
    display: block;
    width: 100%;
    margin: 0em;
  }
  .categoryCard {
    background-color: rgb(255, 255, 255);
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
    display: flex;
    border-radius: 5px;
    margin: 0em 1em;
    width: 10%;
    height: 15em;
    padding: 2px;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    align-content: center;
    flex-wrap: wrap;
    text-align: center;
  }

  .categoryCard a {
    width: 100%;
    height: 100%;
  }

  .category-image {
    width: 100%;
    height: 100%;
}

  .category-image img {
    border-radius: 0px;
    width: 100%;
    height: 80%;
  }
  .category-image img:hover{
    text-decoration: none;
    transform: scale(1.05);
    transition: transform 0.5s ease;
  }
</style>
