function randomQuotes() {
    return fetch('https://api.quotable.io/random')
        .then(response => response.json())
        .then(data => {
            const quote = `"${data.content}" - ${data.author}`;
            return quote;
        })
        .catch(error => {
            console.error('Error fetching quote:', error);
            throw error; // Re-throw the error so it can be handled by the calling code
        });
}

async function displayRandomQuote() {
    try {
        const quote = await randomQuotes();
        console.log(quote);
        document.getElementById('quotesGenerate').textContent = quote;
    } catch (error) {
        // Handle the error
        console.error('Error:', error);
    }
}
