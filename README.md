# Perch-Edit-Pages-from-Dashboard
Displays a list of all Region items from all Pages on the dashboard in [Perch CMS](http://grabaperch.com). You can click each Page or Region item to go to its edit-page.

## What's it for  
This addon makes it possible for a user to do the following   
1. Go to the Perch Dashboard
2. Choose a Page or Region-item from the list 
3. Click the item to take them directly to the edit page in Perch. 
  
(Not tested on Runway, not tested for blocks) 
  
<img src="/screenshot/Pages_on_Dashboard.png" width="600">


## Installation Quick overview
1. Install the app 'RB_EditPages' into the Perch `perch/addons/apps` folder 
2. Show the Dashboard by setting 'Enable dashboard' in Perch Settings


## Usage Quick overview
1. Go to the Dashboard, a list of items and pages will be shown, Behind every Region item, the Region name is displayed
2. Click a Page or an item to go to its Edit page.
3. If an item name is 'item (no title=true in template for this item)', it means in the content template there was no `title='true'` defined.
  
  
## How to install -detailed
1. Download the repository, it contains a Perch-like folder structure
2. Copy the folder  `'RB_EditPages'` to folder: `perch/addons/apps/` 
3. The folder contains a stylesheet if you want to change the looks of the Widget. Some default Perch classes have been used. The first two items hide the default 'pages' and 'forms' widgets.
    

## Todo   
- Test it with blocks. Its tested for regions (including a repeater). 
- Test for Runway.

<img src="/screenshot/Pages_on_Dashboard02.png" width="600">
