
class Site {
    
    constructor() {

        $(document.body).on('click', 'a[href^="#"]', this.scrollToAnchor.bind(this) );

    }

    scrollToAnchor( e ) {
        e.preventDefault();

        let href = $(e.currentTarget).attr('href');

        if ( href === '#' )
            return;

        let anchor = $(document.body).find( href );

        if ( !anchor.length ) {
            return;
        }

        $('html, body').animate({ scrollTop: anchor.offset().top });

    }
    
}


new Site();