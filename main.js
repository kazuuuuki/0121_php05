const API_KEY =
  'api_key=45c25653ca26e0b73c7a85631bd53f87&language=ja-JA&query=';
const BASE_URL = 'https://api.themoviedb.org/3';
const API_URL = BASE_URL + '/discover/movie?sort_by=popularity.desc&' + API_KEY;
const IMG_URL = 'https://image.tmdb.org/t/p/w500';
const searchURL = BASE_URL + '/search/movie?' + API_KEY;

const main = document.getElementById('main');
const form = document.getElementById('form_search');
const search = document.getElementById('search');

function getMovies(url) {
  fetch(url)
    .then((res) => res.json())
    .then((data) => {
      console.log(data.results);
      showMovies(data.results);
    });
}

function showMovies(data) {
  main.innerHTML = '';
  data.forEach((movie) => {
    const { title, poster_path, overview } = movie;
    const movieEl = document.createElement('div');
    movieEl.classList.add('movie');
    movieEl.innerHTML = `
        <img src="${IMG_URL + poster_path}" alt="${title}">

        <div class="movie-info">
            <h2>${title}</h2>
        </div>

        <div class="overview">

            <h3>🎬あらすじ🎬</h3>
            ${overview}
        </div>
    
    `;

    main.appendChild(movieEl);
    console.log(movieEl);
  });
}

form.addEventListener('submit', (e) => {
  e.preventDefault();
  const searchTerm = search.value;

  if (searchTerm) {
    getMovies(searchURL + '&query=' + searchTerm);
  } else {
    getMovies(API_URL);
  }
});

//あらすじをふわっと表示させたい

// $(function () {
//   $('.movie').hover(function () {
//     $('.overview').fadeIn(5000);
//     console.log(this);
//   });
// });
