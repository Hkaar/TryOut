export default function PhotoSVG() {
    const svgNS = "http://www.w3.org/2000/svg";
    
    const svg = document.createElementNS(svgNS, "svg");
    svg.setAttribute("data-name", "Layer 1");
    svg.setAttribute("viewBox", "0 0 816.22237 700.597");
    svg.setAttribute("xmlns:xlink", "http://www.w3.org/1999/xlink");
    
    const pathsData = [
        {
            d: "M772.0209,797.89518a34.81426,34.81426,0,0,1-16.74561-4.30859L278.867,533.04069a35.03942,35.03942,0,0,1-13.9137-47.50147L466.00063,117.924a34.99945,34.99945,0,0,1,47.50171-13.91358l476.4082,260.5459a35.03913,35.03913,0,0,1,13.91382,47.50147L802.777,779.673a34.7714,34.7714,0,0,1-20.86914,16.79492A35.147,35.147,0,0,1,772.0209,797.89518Zm-13.8667-9.57227a29.00079,29.00079,0,0,0,39.35864-11.5288L998.5602,409.17887A29.03345,29.03345,0,0,0,987.03164,369.82L510.62344,109.27409a29.00081,29.00081,0,0,0-39.35865,11.5288L270.21743,488.41813A29.03335,29.03335,0,0,0,281.746,527.777Z",
            transform: "translate(-191.88882 -99.7015)",
            fill: "#f2f2f2"
        },
        {
            d: "M781.84414,669.32487a32.70567,32.70567,0,0,1-15.68262-4.0166L380.99917,454.66471a32.46947,32.46947,0,0,1-12.91992-44.1084L488.151,191.005a32.49693,32.49693,0,0,1,44.10865-12.91992L917.42226,388.72868a32.49758,32.49758,0,0,1,12.91993,44.10839l-.43873-.23974.43873.23974L810.27041,652.38834A32.3643,32.3643,0,0,1,781.84414,669.32487Z",
            transform: "translate(-191.88882 -99.7015)",
            fill: "#f2f2f2"
        },
        {
            d: "M769.88882,797.7985h-543a32.53692,32.53692,0,0,1-32.5-32.5v-419a32.53692,32.53692,0,0,1,32.5-32.5h543a32.53685,32.53685,0,0,1,32.5,32.5v419A32.53685,32.53685,0,0,1,769.88882,797.7985Z",
            transform: "translate(-191.88882 -99.7015)",
            fill: "#fff"
        },
        {
            d: "M769.88882,800.2985h-543a35.03947,35.03947,0,0,1-35-35v-419a35.03947,35.03947,0,0,1,35-35h543a35.03947,35.03947,0,0,1,35,35v419A35.03947,35.03947,0,0,1,769.88882,800.2985Zm-543-483a29.03275,29.03275,0,0,0-29,29v419a29.03275,29.03275,0,0,0,29,29h543a29.03276,29.03276,0,0,0,29-29v-419a29.03276,29.03276,0,0,0-29-29Z",
            transform: "translate(-191.88882 -99.7015)",
            fill: "#e6e6e6"
        },
        {
            d: "M582.89156,451.586a40.76358,40.76358,0,0,0-32.55116,16.18593,26.83976,26.83976,0,0,0-37.44912,24.64757H623.72505A40.83342,40.83342,0,0,0,582.89156,451.586Z",
            transform: "translate(-191.88882 -99.7015)",
            fill: "#e6e6e6"
        },
        {
            d: "M148.19669,445.96036a65.75727,65.75727,0,1,0,65.75727,65.75727A65.75727,65.75727,0,0,0,148.19669,445.96036Z",
            fill: "#46564d"
        },
        {
            d: "M725.24868,681.17851a31.87811,31.87811,0,0,1-7.35986.85h-439a31.87492,31.87492,0,0,1-15.46-3.97l1.16992-1.68,48.98-70.53,72.58008-104.49,1.06-1.53,11.41993-16.44a8.33693,8.33693,0,0,1,13.70019,0l37.93994,54.61v.01l22.31983,32.14,53.28027,76.7,80.80957-115.35a8.34782,8.34782,0,0,1,13.68018,0l51.83984,73.99,2.98,4.25Z",
            transform: "translate(-191.88882 -99.7015)",
            fill: "#3f3d56"
        },
        {
            d: "M495.61848,519.76805A50.29271,50.29271,0,0,0,455.458,539.7377,33.114,33.114,0,0,0,409.2545,570.147h136.743A50.3789,50.3789,0,0,0,495.61848,519.76805Z",
            transform: "translate(-191.88882 -99.7015)",
            fill: "#ccc"
        },
        {
            d: "M717.88882,683.02848h-439a32.97007,32.97007,0,0,1-33-33V399.78873a33.03734,33.03734,0,0,1,33-33h439a33.03734,33.03734,0,0,1,33,33V650.02848a32.96211,32.96211,0,0,1-33,33Zm-439-314.23975a31.0352,31.0352,0,0,0-31,31V650.02848a30.97077,30.97077,0,0,0,31,31h439a30.9637,30.9637,0,0,0,31-31V399.78873a31.03521,31.03521,0,0,0-31-31Z",
            transform: "translate(-191.88882 -99.7015)",
            fill: "#3f3d56"
        }
    ];

    pathsData.forEach(pathData => {
        const path = document.createElementNS(svgNS, "path");
        path.setAttribute("d", pathData.d);
        path.setAttribute("transform", pathData.transform ? pathData.transform : '');
        path.setAttribute("fill", pathData.fill);
        svg.appendChild(path);
    });

    return svg;
}
