import requests
from bs4 import BeautifulSoup, SoupStrainer
import mysql.connector

#declare the master list
master_list = []

#find pagination in order to declare range
#paginantion = soup.find_all(attrs={"class":"search-results__pagination"})
#print(paginantion)
#note that range is currently set at 2 as I continue to develop. for final version, set range as equal to pagination. pagination also still needs cleaned up a bit.

for i in range(39):#see comment above about the range and pagination. as of 02/08/2020, there are 39 pages of size 20
    int = i
    link = "https://www.majestic.co.uk/wine?pageNum=" + str(int) +"&pageSize=20"

    webpage_response = requests.get(link)

    webpage = webpage_response.content
    soup = BeautifulSoup(webpage, "html.parser")

    wine_links = soup.find_all(attrs={"class":"product-details__header--calais"})
    links = []
    prefix = "https://www.majestic.co.uk"
    #go through all of the a tags and get the links associated with them"
    for a in wine_links:
        links.append(prefix+a["href"])

    #now, go down each link and compile all the data about the wines into one big list
    #follow each link:
    for link in links:
      #print(link)
      try: #try/except for error handling
          webpage = requests.get(link)
          soup = BeautifulSoup(webpage.content, "html.parser")

          #get the wine name
          wine_name = soup.select("title")[0].get_text()
          wine_name_clean = wine_name.strip(" - Majestic Wine")
          wine_name_clean_list = []
          wine_name_list = wine_name_clean.split("\n")

          #now get the wine price
          wine_price = soup.find(attrs={"class":"product-action__price-text"})
          wine_price_text = wine_price.get_text()
          wine_price_text_clean = wine_price_text.replace(" ", "").replace("MixSix", "").replace("\n", "").replace("£", "")

          #and now get the product description
          wine_description = soup.find(attrs={"class":"product-content__description"})
          wine_description_clean = wine_description.get_text().strip()

          #finally, get the wine attributes
          wine_attributes = soup.tbody
          wine_attributes_text = wine_attributes.get_text()
          wine_attributes_text_clean = wine_attributes_text.replace("\n\n", "")

          #add wine price and wine description to wine attributes
          wine_attributes_price_description = wine_attributes_text_clean + "\n" + wine_price_text_clean + "\n" + wine_description_clean

          wine_details_list = []
          wine_details_list = wine_attributes_price_description.split("\n")

          #now clean up our list so we're left with only the data we want
          if 'Volume' in wine_details_list:
              del wine_details_list[0]

          profile_index = []
          for i in range(0, len(wine_details_list)) :
              if wine_details_list[i] == 'Profile' :
                  profile_index.append(i)
          profile_index_int = profile_index[0]

          type_index = []
          for i in range(0, len(wine_details_list)) :
              if wine_details_list[i] == 'Type' :
                  type_index.append(i)
          type_index_int = type_index[0]

          del wine_details_list[profile_index_int:type_index_int+1]

          if 'Grape' in wine_details_list:
            del wine_details_list[2]
          else:
              wine_details_list.insert(2, "NA")

          style_index = []
          for i in range(0, len(wine_details_list)) :
              if wine_details_list[i] == 'Style' :
                  style_index.append(i)
          style_index_int = style_index[0]

          country_index = []
          for i in range(0, len(wine_details_list)) :
              if wine_details_list[i] == 'Country' :
                  country_index.append(i)
          country_index_int = country_index[0]

          del wine_details_list[style_index_int:country_index_int+1]
          #print(wine_details_list)

          #that's now all of the data cleaned up

          #finally, add wine attributes and price as a sublist of each wine
          wine_name_list.append(wine_details_list)
          #print(wine_name_list)

          #and very finally, add the wine in question to the master list, before going back to the top and doing it all over again with the next wine
          master_list.append(wine_name_list)
      except:
          print("Problem with ", link)
          continue

#print(master_list)

#now add the wines to the database
#open connection with database
conn = mysql.connector.connect(
    host="localhost",
    port="3306",
    database="whinefreewine",
    user="root",
    passwd=""
 )

mycursor = conn.cursor()

#go through the wines one by one and add them to the database
for i in range(len(master_list)):

    wine_name = master_list[i][0]
    volume = master_list[i][1][0]
    colour = master_list[i][1][1]
    grape = master_list[i][1][2]
    country = master_list[i][1][3]
    price = master_list[i][1][4]
    description = master_list[i][1][5]

    sql = "INSERT INTO wine (wine_name, volume, colour, grape, country, price, description) VALUES (%s, %s, %s, %s, %s, %s, %s)"
    val = (wine_name, volume, colour, grape, country, price, description)
    mycursor.execute(sql, val)

    conn.commit()

#close connection with database
conn.close()

""" identified problems as followed
Problem with  https://www.majestic.co.uk/wines/ch-caillou-pomerol-61159
Problem with  https://www.majestic.co.uk/wines/chateau-lyonnat-2004-lussac-saint-emilion-61205
Problem with  https://www.majestic.co.uk/wines/macon-chardonnay-reserve-cave-de-lugny-64120
Problem with  https://www.majestic.co.uk/wines/parcel-series-organic-tempranillo-2017-spain-14688
Problem with  https://www.majestic.co.uk/wines/santa-tresa-organic-rose-8315
Problem with  https://www.majestic.co.uk/wines/letoile-de-begude-chardonnay-10355
Problem with  https://www.majestic.co.uk/wines/dehasa-gago-tinta-de-toro-14643
Problem with  https://www.majestic.co.uk/wines/yellow-tail-rose-8232
Problem with  https://www.majestic.co.uk/wines/parcel-series-organic-gruner-veltliner-12078
Problem with  https://www.majestic.co.uk/wines/domaine-de-labbaye-saint-hilaire-rose-8340
Problem with  https://www.majestic.co.uk/wines/thierry-delaunay-ceptembre-sauvignon-blanc-2019-5389
Problem with  https://www.majestic.co.uk/wines/domaine-begude-le-paradis-viognier-10086
Problem with  https://www.majestic.co.uk/wines/puligny-montrachet-2016-doudet-naudin-64118
Problem with  https://www.majestic.co.uk/wines/torbreck-descendant-shiraz-59138
Problem with  https://www.majestic.co.uk/wines/vina-tondonia-rioja-reserva-2006-14665
Problem with  https://www.majestic.co.uk/wines/eileen-hardy-chardonnay-59182
Problem with  https://www.majestic.co.uk/wines/henri-pion-morey-st-denis-63044
Problem with  https://www.majestic.co.uk/wines/talbott-kali-hart-chardonnay-18967
Problem with  https://www.majestic.co.uk/wines/jaume-organic-lirac-6317
Problem with  https://www.majestic.co.uk/wines/baba-marta-sauvignon-blanc-21086
Problem with  https://www.majestic.co.uk/wines/nazare-north-canyon-15025
Problem with  https://www.majestic.co.uk/wines/stone-arka-merlot-21100
Problem with  https://www.majestic.co.uk/wines/freestyle-organic-blanc-10371
Problem with  https://www.majestic.co.uk/wines/pouilly-fuisse-2018-domaine-trouillet-64126
Problem with  https://www.majestic.co.uk/wines/qupe-syrah-2016-central-coast-18757
Problem with  https://www.majestic.co.uk/wines/domaine-foucher-menetou-salon-5034
Problem with  https://www.majestic.co.uk/wines/pedros-almacenista-selection-fino-24006
Problem with  https://www.majestic.co.uk/wines/chapoutier-mirabel-viognier-10375
Problem with  https://www.majestic.co.uk/wines/jackson-est-outland-pinot-n-18760
Problem with  https://www.majestic.co.uk/wines/mt-brave-mt-veeder-malbec-18762
Problem with  https://www.majestic.co.uk/wines/sanford-benedict-chardonnay-18537
Problem with  https://www.majestic.co.uk/wines/stone-arka-chardonnay-21200
Problem with  https://www.majestic.co.uk/wines/qupe-marsanne-2016-central-coast-18758
Problem with  https://www.majestic.co.uk/wines/clos-du-clocher-2014-pomerol-61203
Problem with  https://www.majestic.co.uk/wines/clos-de-la-grande-organic-cotes-du-rhone-6584
Problem with  https://www.majestic.co.uk/wines/ch-duhart-milon-2002-61188
Problem with  https://www.majestic.co.uk/wines/cuvee-maurer-2018-maurer-serbia-21021
Problem with  https://www.majestic.co.uk/wines/howard-park-chardonnay-59178
Problem with  https://www.majestic.co.uk/wines/bott-frigyes-pinot-noir-2018-slovakia-21092
Problem with  https://www.majestic.co.uk/wines/plavac-mali-trica-2017-vinarija-kriz-38033
Problem with  https://www.majestic.co.uk/wines/saumur-lulu-lalouette-5380
Problem with  https://www.majestic.co.uk/wines/cambria-bench-break-chard-18759
Problem with  https://www.majestic.co.uk/wines/bott-frigyes-kekfrankos-2018-slovakia-21036
Problem with  https://www.majestic.co.uk/wines/mt-brave-mt-veeder-cab-s-18763
Problem with  https://www.majestic.co.uk/wines/mt-brave-mt-veeder-merlot-18761
Problem with  https://www.majestic.co.uk/wines/chateau-les-tresquots-medoc-61212
Problem with  https://www.majestic.co.uk/wines/kaiken-aventura-bordeaux-blend-40188
Problem with  https://www.majestic.co.uk/wines/bott-frigyes-furmint-2018-slovakia-21059
Problem with  https://www.majestic.co.uk/wines/chemin-moscou-organic-rouge-9125
Problem with  https://www.majestic.co.uk/wines/majestic-mulled-wine-21111
Problem with  https://www.majestic.co.uk/wines/jaboulet-cornas-6610
Problem with  https://www.majestic.co.uk/wines/baron-de-boutisse-st-emilion-61221
Problem with  https://www.majestic.co.uk/wines/torbreck-runrig-shiraz-59152
"""
