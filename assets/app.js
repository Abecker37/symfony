/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
import 'bootstrap-icons/font/bootstrap-icons.css';
require('bootstrap');
// start the Stimulus application
import './bootstrap';

document.getElementById('watchlist').addEventListener('click', addToWatchlist);

function addToWatchlist(e) {
    e.preventDefault();
    const watchlistLink = e.currentTarget;

    const link = watchlistLink.href;

    // Send an HTTP request with fetch to the URI defined in the href

    try {
        
        fetch(link)

            // Extract the JSON from the response

            .then(res => res.json())

            // Then update the icon

            .then(data => {

                const watchlistIcon = watchlistLink.firstElementChild;

                if (data.isInWatchlist) {

                    watchlistIcon.classList.remove("bi-heart"); // Remove the .bi-heart (empty heart) from classes in <i> element

                    watchlistIcon.classList.add("bi-heart-fill"); // Add the .bi-heart-fill (full heart) from classes in <i> element

                } else {

                    watchlistIcon.classList.remove("bi-heart-fill"); // Remove the .bi-heart-fill (full heart) from classes in <i> element

                    watchlistIcon.classList.add("bi-heart"); // Add the .bi-heart (empty heart) from classes in <i> element

                }

            });

    } catch (err) {

        console.error(err);

    }
}