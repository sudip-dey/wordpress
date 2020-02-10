// 3rd party packages from NPM
import $ from 'jquery';
import slick from 'slick-carousel';

// Our modules / classes
import MobileMenu from './modules/MobileMenu';
import HeroSlider from './modules/HeroSlider';
import Search from './modules/Search';

// Instantiate a new object using our modules/classes
var mobileMenu = new MobileMenu();
var heroSlider = new HeroSlider();
var amazingSearch = new Search();


/*$.getJSON('http://localhost/wordpress/wp-json/wp/v2/posts', function(data){
    //alert(data[0].title.rendered);
    data.map(item => alert(item.title.rendered)).join('');
           
});*/

//alert(myScript.customVal);

/*$.getJSON('http://localhost/wordpress/wp-json/wp/v2/posts', function(data){
    //alert(data[0].title.rendered);


    var responseHTML = `<h1>Search Results</h1>
        <ul>
        ${data.map(item => `<li>${item.title.rendered} posted by ${item.authorName != 'admin' ? 'admin' : 'anonymous'}</li>`).join('')}
        </ul>
    `;
    alert(responseHTML);
        
});*/