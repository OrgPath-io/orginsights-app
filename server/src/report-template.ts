import { bottomPercentGauges, reportAssets, reportFonts, topPercentGauges } from "./report-assets";
import { legacyReportBackgrounds } from "./legacy-report-backgrounds";
import { legacyReportCss } from "./original-report-css";

export type ReportScore = { id: number; name: string; categoryId?: number; mean: number | null; percent: number | null };
export type ReportCategory = { id: number; name: string; description?: string | null };
export type ReportCapability = { id: number; name: string; description?: string | null; categoryId?: number | null };
export type FullReportData = {
  self: { capScores: ReportScore[]; pillarScores: ReportScore[] };
  professional: { capScores: ReportScore[]; pillarScores: ReportScore[] };
  raterCaps: ReportScore[];
  raterPillars: ReportScore[];
  invitedRaters: number;
  completedRaters: number;
  gaps: { name: string; self: number; rater: number; gap: number }[];
  top: ReportScore[];
  low: ReportScore | null;
  industries: { industryName?: string | null }[];
  courses: { title?: string | null; length?: string | null; level?: string | null; url?: string | null }[];
};
export type TemplateInput = {
  candidateName: string;
  reportDate: string;
  detailed: boolean;
  teaser?: boolean;
  comparisonSource?: "professional" | "raters";
  report: FullReportData;
  categories: ReportCategory[];
  capabilities: ReportCapability[];
  comments: { categoryId: number; top: string; low: string; hidden: string; blind: string }[];
};

const asset = (name: keyof typeof reportAssets) => reportAssets[name];
const esc = (value: unknown) => String(value ?? "").replace(/[&<>"']/g, (character) => ({ "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" })[character] ?? character);
const scoreMean = (score: ReportScore | undefined) => Math.max(0, Math.min(5, Number(score?.mean ?? 0)));
const scorePercent = (score: ReportScore | undefined) => Math.max(0, Math.min(100, Math.round(Number(score?.percent ?? scoreMean(score) * 20))));
const gaugeKey = (score: ReportScore | undefined) => (Math.round(scoreMean(score) * 10) / 10).toFixed(1);
// Legacy source trace: pdfpage.php/page.php use a page_break between every template page
// and add this copyright block once at the foot of the final page.
const legacyFooter = `<div class="footer"><p>Copyrights 2026 OrgInsights. All Rights Reserved</p></div>`;
const page = (html: string, className = "", final = false) => `<section class="legacy-page ${className}">${html}${final ? legacyFooter : ""}</section>`;
// Legacy source trace: repeated page-logo block in pdfpage.php/page.php pages 2 through conclusion.
const pageLogo = () => `<div class="page-logo"><img src="${asset("images/logo.png")}" alt=""><div class="site-name">orginsight.io <div class="green-box"></div></div></div>`;
const pageHeader = (title: string, subtitle = "", body = "", className = "") => `<div class="page-header ${className}"><h1 class="${className === "page6-header" ? "page6-headline" : subtitle ? "main-headline" : "page4-headline"}">${title}</h1>${subtitle ? `<h2 class="sub-headline">${subtitle}</h2>` : ""}${body ? `<p>${body}</p>` : ""}</div>`;
const graphSegments = (score: number) => {
  const fillPercent = Math.max(0, Math.min(100, score));
  const dividers = Array.from({ length: 5 }, () => `<div class="graph-box"></div>`).join("");
  return `<div class="progress" style="width:${fillPercent}%"></div>${dividers}`;
};

function usesRaterFeedback(input: TemplateInput) { return input.comparisonSource === "raters"; }
function comparisonLabel(input: TemplateInput) { return usesRaterFeedback(input) ? "INVITED RESPONDENTS SCORE" : "ORGINSIGHTS ASSESSMENT SCORE"; }
function comparisonPillarScores(input: TemplateInput) { return usesRaterFeedback(input) ? input.report.raterPillars : input.report.professional.pillarScores; }
function comparisonCapabilityScores(input: TemplateInput) { return usesRaterFeedback(input) ? input.report.raterCaps : input.report.professional.capScores; }
function categoryScore(report: FullReportData, id: number, kind: "self" | "professional") { return report[kind].pillarScores.find((item) => item.id === id); }
function capabilityScore(report: FullReportData, id: number, kind: "self" | "professional") { return report[kind].capScores.find((item) => item.id === id); }
function selfCategoryScore(report: FullReportData, id: number) { return categoryScore(report, id, "self"); }
function selfCapabilityScore(report: FullReportData, id: number) { return capabilityScore(report, id, "self"); }
function comparisonCategoryScore(input: TemplateInput, id: number) { return comparisonPillarScores(input).find((item) => item.id === id); }
function comparisonCapabilityScore(input: TemplateInput, id: number) { return comparisonCapabilityScores(input).find((item) => item.id === id); }
const legacySummaryCopy: Record<string, Record<"top" | "low" | "hidden" | "blind", string>> = {
  "Achieves Excellence": {
    top: "One of your top strengths is the ability to take ownership of projects and goals and drive towards concrete results, this includes actively developing future talents, making financially sound judgements and driving team performance and increasing productivity.",
    low: "An area that you can improve on is taking more ownership of projects and goals and drive towards concrete results, this includes actively developing future talents, making financially sound judgements and driving team performance and increasing productivity. Start developing this capability by taking full responsibility of everything under your influence, continuously seek to develop self-growth and invests in the development of others as well.",
    hidden: "You may not be aware of this aspect of your strengths, however, your ability to take ownership of projects and goals and drive towards concrete results has enabled your success thus far, this includes actively developing future talents, making financially sound judgements and driving team performance and increase productivity.",
    blind: "An area for growth lies in ability to take ownership of projects and goals and drive towards concrete results, this includes actively developing future talents, making financially sound judgements and driving team performance and increase productivity. Becoming aware is first step then, start developing this capability by taking full responsibility of everything under your influence, continuously seek to develop self-growth and invests in the development of others as well.",
  },
  "Develops Relationships": {
    top: "You focus on building positive working relationships with customers and identifying opportunities to create partnerships; you find it easy to influence others by displaying empathy, knowing what motivates them, and finding common grounds.",
    low: "Building and maintaining positive customer relationships may not have been an area that you prioritized in the past. Start developing this capability by creating alliances, influence others by knowing what motivates them. It's also important to demonstrate empathy while resolving conflicts and focusing on the customer. That is how great relationships are built.",
    hidden: "Because this is something that comes very natural to you, you may not be aware of your strengths in building positive working relationships with customers and identifies opportunities to create partnerships; you find it easy to influence others by displaying empathy, knowing what motivates them, and finding common grounds.",
    blind: "An area of development lies in your ability to build and maintain positive working relationships with customers. First step is becoming aware of this blind spot and then act to develop a plan to create alliances, influence others by knowing what motivates them. It's also important to demonstrate empathy while resolving conflicts and focusing on the customer. That is how great relationships are built.",
  },
  "Embraces Agility": {
    top: "Your strength lies in being able to anticipate and respond to changes with swift, focused, and future-oriented actions; You are able to thrive on chaos, navigate changes with tact and political savviness thus allowing you to achieve desired results.",
    low: "You may prefer to keep changes to a minimum and may rarely need to do things differently than how they have been done before. However, with the everchanging business landscape that we operate in, it is important to accept some degree of uncertainty and seek fresh challenges that will in term help you learn to embrace change.",
    hidden: "Being able to anticipate and respond to changes with swift, focused, and future-oriented actions may be a strength that you have overlooked in the past. You are able to thrive on chaos, navigate changes with tact and political savviness thus allowing you to achieve desired results.",
    blind: "An area for growth lies in your ability to anticipate and respond to changes with swift, focused, and future-oriented actions; First step is becoming aware of this blind stop and then act to develop a plan that will help you accept some degree of uncertainty and seek fresh challenges that will in term help you learn to embrace change.",
  },
  "Limits Risk": {
    top: "You have an innate awareness of potential risks that could be political, social, or economical in nature existing in the operating ecosystem, and you are proactive in identifying process and procedures to mitigate negative impacts in order to attain goals and objectives. Continue to leverage this capability as it will propel you towards future success.",
    low: "An area that you can start improving to gain immediate results is in becoming more aware of potential risks that could be political, social, or economical in nature. This includes anticipating those risks ahead of time. It is also important to develop your ability to identify process and procedures to mitigate negative impacts in order to attain goals and objectives.",
    hidden: "You may have overlooked this capability which is one of your top strengths so far. You have an innate awareness of potential risks that could be political, social, or economical in nature existing in the operating ecosystem, and you are proactive in identifying process and procedures to mitigate negative impacts in order to attain goals and objectives.",
    blind: "You may not have an innate awareness of potential risks that could be political, social, or economical in nature existing in the operating ecosystem. This is an area that you can start developing by first understanding different types of risks, and then begin developing your ability to identify process and procedures to mitigate negative impacts in order to attain goals and objectives.",
  },
  "Sets Purpose": {
    top: "Your propensity to create a common purpose, articulate a compelling vision and inspire alignment to make a positive difference is a strength that will aid in your ongoing success in your career. Keep leveraging this capability to propel you towards future successes.",
    low: "Creating a shared sense of common purpose may not be something that comes natural to you. Act to develop a plan that will help you articulate a clear and compelling vision of the future with more ease and be inclusive of diverse perspectives when decisions are being made. This is one of the fastest ways to ensure buy-in and results.",
    hidden: "You may not be aware of this aspect of your strengths, however, your propensity to create a common purpose and articulate a compelling vision to inspire alignment to make a positive difference is a strength that will aid in your ongoing success in your career.",
    blind: "Creating a shared sense of purpose may not be something that comes natural to you. First step is becoming aware of this blind stop and then act to develop a plan that will help you articulate a clear and compelling vision of the future with more ease and be inclusive of diverse perspectives when decisions are being made. This is one of the fastest ways to ensure buy-in and results.",
  },
};
function commentFor(input: TemplateInput, category: ReportCategory, kind: "top" | "low" | "hidden" | "blind") {
  const stored = input.comments.find((item) => item.categoryId === category.id)?.[kind]?.trim();
  return stored || legacySummaryCopy[category.name]?.[kind] || "";
}
function scoreGraph(name: string, selfScore: ReportScore | undefined, comparisonScore: ReportScore | undefined, comparisonScoreLabel: string, iconHtml = "", numberHtml = "") {
  const self = scorePercent(selfScore), comparison = scorePercent(comparisonScore), gap = comparison - self;
  const title = numberHtml ? name : name.toUpperCase();
  return `<div class="score-graph page6-score-graph"><div class="${numberHtml ? "round-wrapper" : "letter"}">${numberHtml ? `<div class="round">${numberHtml}</div>` : esc(name.charAt(0).toUpperCase())}</div><div class="right-section"><div class="title">${esc(title)}</div><small class="score-label self-score-label">YOUR SCORE</small><div class="middle-wrapper"><div class="main-graphs"><div class="graph-wrapper graph-wrapper-1">${graphSegments(self)}</div><div class="graph-wrapper graph-wrapper-2">${graphSegments(comparison)}</div></div><div class="graph-rating"><div class="rate-1">${self}%</div><div class="rate-2">${comparison}%</div></div><div class="gap"><b>GAP</b> ${gap}%</div><div class="icon">${iconHtml}</div></div><small class="score-label org-score-label">${esc(comparisonScoreLabel)}</small></div></div><div class="clear-fix"></div>`;
}

// Legacy source trace: pdfpage.php/page.php Page 1. Only candidate name and report date are substituted.
function coverPage(input: TemplateInput) {
  const title = usesRaterFeedback(input) ? "360 Assessment" : "OrgInsights Assessment";
  return page(`<div class="logo"><img src="${asset("images/logo.png")}" alt="OrgInsights"></div><div class="banner"><img src="${asset("images/banner.jpg")}" alt=""></div><div class="text-center"><h1 class="main-title">${title}</h1><h2 class="main-title__sub">${esc(input.candidateName)}</h2><br><span>${esc(input.reportDate)}</span></div>`, "cover-page");
}
// Legacy source trace: pdfpage.php Page 2, non-360 OrgInsights-assessment conditional.
function aboutPage(input: TemplateInput) {
  const raterReport = usesRaterFeedback(input);
  const items = [raterReport ? "It will show you the gap (positive or negative) between your perception of your capabilities and the average ratings from the people you invited to respond." : "It will show you the gap (positive or negative) between your perception of your capabilities, and what our OrgInsights Assessment rated you.", "The report will highlight the most important skills that you need to develop to address gaps and to improve your competitive edge", "Because feedback from others is generally twice as accurate as your own assessment, this report will help increase your self awareness. The first step to great leaders, is knowing your capabilities; we want to help you on that journey."];
  const standardSummaryOpening = "First Breathe: Take all the information you see ahead in your stride. Perhaps you are not as strong as you thought in a capability. Maybe you don’t have experience with an ability. Scoring low is not bad. It just means like everyone else, you have room to improve.";
  const raterSummaryOpening = "First Breathe: Take all the information you see ahead in your stride. Perhaps individuals haven't seen you operating at your best? This doesn't mean that you are not capable of more. They may have higher expectations or may not have seen the extent of your true capabilities.";
  const summary = [raterReport ? raterSummaryOpening : standardSummaryOpening, raterReport ? "You will see your own self-assessment scores compared to that of the individuals you invited to respond. If you don't agree with the scores provided, take a step back and do your own research. Develop a holistic understanding of why you may have received these ratings." : "You will see your own self-assessment scores compared to that of the OrgInsights assessment you built. There was logic behind how it was built. If you don't agree with the scores provided, take a step back and do your own research. Develop a holistic understanding of why you may have received these ratings.", "Unused strengths are quickly lost. Like any muscle in your body, you need to constantly practice and develop your capabilities to ensure that they stay assets to you.", ...(raterReport ? ["The information provided has been kept anonymous, and there is a reason for that. Individuals will provide more honest feedback when they know it will not be traced back to them. Do not try and find out who the individuals who answered are as this will affect the honesty of future responses."] : []), "Your ratings will be displayed on a scale from 0 (needs improvement) to 5 (exceptional)."];
  const raterCounts = raterReport ? `<div class="rater-counts"><div><strong>${input.report.invitedRaters}</strong><span>PEOPLE INVITED</span></div><div><strong>${input.report.completedRaters}</strong><span>PEOPLE COMPLETED</span></div></div>` : "";
  return page(`${pageLogo()}${pageHeader("ABOUT", "THIS REPORT", `Thank you for completing the ${raterReport ? "360 Assessment" : "OrgInsights Assessment"}. The following pages will walk you through your results. This report will help you in the following ways:`)}<div class="container about-list">${raterCounts}<div class="legacy-spacers"><p>-</p><p>-</p><p>-</p><p>-</p></div><ul>${items.map((text) => `<li><div class="icon-wrapper"><img src="${asset("images/check_mark.png")}" alt="" class="icon"></div><div class="text">${text}</div></li>`).join("")}</ul></div><div class="report-summary-wrapper"><div class="report-summary"><img src="${asset("images/hands.png")}" alt="" class="hands"><div class="container"><h5>Report Summary</h5><ul>${summary.map((text, index) => `<li><div class="icon-wrapper"><div class="number-icon">${index + 1}</div></div><div class="text">${text}</div></li>`).join("")}</ul></div></div></div><div class="ideal-score-section"><h4>Ideal Score</h4><p class="ideal-score-sub">(Based on experience/level)</p><div class="ideal-score-grid"><div class="ideal-score-box"><div class="ideal-score-label">Students/New Grad</div><div class="ideal-score-body"><span class="ideal-score-avg">Avg Score</span><strong class="ideal-score-pct">30%</strong><span class="ideal-score-range">1-2: 50%</span></div></div><div class="ideal-score-box"><div class="ideal-score-label">Experienced Hires</div><div class="ideal-score-body"><span class="ideal-score-avg">Avg Score</span><strong class="ideal-score-pct">40%</strong><span class="ideal-score-range">1-2: 60%</span></div></div><div class="ideal-score-box"><div class="ideal-score-label">Business Consultants<br/>/Jr Employees</div><div class="ideal-score-body"><span class="ideal-score-avg">Avg Score</span><strong class="ideal-score-pct">40%</strong><span class="ideal-score-range">3-7: 70%</span></div></div><div class="ideal-score-box"><div class="ideal-score-label">Lead/Manager</div><div class="ideal-score-body"><span class="ideal-score-avg">Avg Score</span><strong class="ideal-score-pct">60%</strong><span class="ideal-score-range">1-2: 50%</span></div></div><div class="ideal-score-box"><div class="ideal-score-label">Director/AVP</div><div class="ideal-score-body"><span class="ideal-score-avg">Avg Score</span><strong class="ideal-score-pct">70%</strong><span class="ideal-score-range">2-3: 80%</span></div></div><div class="ideal-score-box"><div class="ideal-score-label">Senior Leader</div><div class="ideal-score-body"><span class="ideal-score-avg">Avg Score</span><strong class="ideal-score-pct">85%</strong><span class="ideal-score-range">5: 85%</span></div></div></div></div>`, `about-page${raterReport ? " rater-about-page" : ""}`);
}
const canonicalCapabilityOrder: Readonly<Record<string, readonly string[]>> = {
  "Limits Risk": [
    "Scans for Politicals and Internal Impacts",
    "Manages Risk",
    "Reasons Critically and Solves Problems",
    "Establishes Governance",
  ],
  "Embraces Agility": [
    "Navigates Policies and People",
    "Thrives in Chaos",
    "Leads and Embraces Change",
    "Empowers Team Effectiveness",
    "Plans for the Future",
  ],
  "Achieves Excellence": [
    "Develops Talent",
    "Evolves With Technology",
    "Takes Ownership",
    "Drives Performance and Productivity",
    "Exercises Sound Judgement/Consulting",
  ],
  "Develops Relationships": [
    "Creates Alliances",
    "Demonstrates Empathy",
    "Influences Responsibly",
    "Focuses on Customers",
    "Resolves Conflicts",
  ],
  "Sets Purpose": [
    "Inspires Others",
    "Communicates Clarity",
    "Moves Data to Action",
    "Embraces Diversity",
  ],
};
function summaryPage(input: TemplateInput) {
  const comparison = comparisonPillarScores(input);
  const high = [...comparison].sort((a, b) => scoreMean(b) - scoreMean(a))[0], low = [...comparison].sort((a, b) => scoreMean(a) - scoreMean(b))[0];
  const gaps = input.categories.map((category) => ({ category, gap: scoreMean(comparisonCategoryScore(input, category.id)) - scoreMean(selfCategoryScore(input.report, category.id)) })).sort((a, b) => b.gap - a.gap);
  const hidden = gaps[0]?.category, blind = gaps.at(-1)?.category;
  const source = usesRaterFeedback(input) ? "Respondents" : "OrgInsights";
  const box = (title: string, info: string, category: ReportCategory | undefined, image: keyof typeof reportAssets, kind: "top" | "low" | "hidden" | "blind", right = false) => `<div class="summary-box${right ? " float-right" : ""}"><div class="title">${title}</div><div class="info">${info}</div><div class="clear-fix"></div><div class="icon-text"><div class="icon-wrapper"><img src="${asset(image)}" alt=""></div><div class="text">${esc(category?.description ?? "")}</div></div><div class="radius-box-title">${esc(category?.name ?? "Not Assigned")}</div><div class="radius-box radius-box2">${esc(category ? commentFor(input, category, kind) : "")}</div></div>`;
  return page(`${pageLogo()}${pageHeader("HIGH LEVEL SUMMARY OF ASSESSMENT")}<div class="container"><br><br><div class="summary-boxes">${box("TOP SCORING CATEGORY", `${source} rated you highest in this category`, high ? input.categories.find((category) => category.id === high.id) : undefined, "images/summary_icon.png", "top")}${box("LOWEST SCORING CATEGORY", `${source} rated you lowest in this category`, low ? input.categories.find((category) => category.id === low.id) : undefined, "images/lowest-rating-yield-sign.png", "low", true)}</div><div class="summary-boxes">${box("HIDDEN TALENT", `${source} rated you higher in this category than you rated yourself`, hidden, "images/hidden-talent-flags.png", "hidden")}${box("BLIND SPOT", `${source} rated you lower in this category than you rated yourself`, blind, "images/Blind-Spot-talents-red-flags.png", "blind", true)}</div></div>`, "summary-page");
}
// Legacy source trace: pdfpage.php Page 5. It sorts the OrgInsights capability scores,
// selects the top/bottom three, rounds to one decimal, and picks the matching 0.1 gauge asset.
function detailPage(input: TemplateInput, category: ReportCategory) {
  const canonicalOrder = canonicalCapabilityOrder[category.name] ?? [];
  const orderedCapabilities = input.capabilities
    .filter((capability) => Number(capability.categoryId) === category.id)
    .map((capability, sourceIndex) => ({ capability, sourceIndex }))
    .sort((a, b) => {
      const aIndex = canonicalOrder.indexOf(a.capability.name);
      const bIndex = canonicalOrder.indexOf(b.capability.name);
      const aRank = aIndex === -1 ? Number.MAX_SAFE_INTEGER : aIndex;
      const bRank = bIndex === -1 ? Number.MAX_SAFE_INTEGER : bIndex;
      return aRank - bRank || a.sourceIndex - b.sourceIndex;
    })
    .map(({ capability }) => capability);
  const rows = orderedCapabilities.map((capability, index) => { const self = selfCapabilityScore(input.report, capability.id), comparison = comparisonCapabilityScore(input, capability.id), gap = scoreMean(comparison) - scoreMean(self); return scoreGraph(capability.name, self, comparison, comparisonLabel(input), gap >= 2 ? `<img src="${asset("images/green_flag_bg.png")}" alt="Hidden talent">` : gap <= -2 ? `<img src="${asset("images/red_flag_bg.png")}" alt="Blind spot">` : "", String(index + 1)); }).join("");
  const raterReport = usesRaterFeedback(input);
  const comparisonCopy = raterReport ? "the average scores of the individuals you invited to respond" : "your OrgInsights assessment score";
  const hiddenTalentCopy = raterReport ? "You rated yourself lower than your respondents rated you." : "You rated yourself lower than the OrgInsights assessment rated you.";
  const blindSpotCopy = raterReport ? "You rated yourself higher than your respondents rated you." : "You rated yourself higher than the OrgInsights assessment rated you.";
  const categoryGauge = topPercentGauges[gaugeKey(comparisonCategoryScore(input, category.id))] ?? "";
  return page(`${pageLogo()}${pageHeader(`${esc(category.name.toUpperCase())} DETAILED BREAKDOWN`, "", `The next section includes your ratings for the ${esc(category.name)} category. Each capability includes your Self-Assessment score compared with ${comparisonCopy}, as well as the negative or positive gap in scores.`, "page6-header")}<div class="clear-fix"></div><div class="creating-purpose-wrapper"><div class="creating-purpose"><div class="left"><img src="${categoryGauge}" width="100" alt="${scorePercent(comparisonCategoryScore(input, category.id))} percent"><span>CATEGORY SCORE</span></div><div class="middle"><div class="title">${esc(category.name.toUpperCase())}</div><p>${esc(category.description ?? "")}</p></div><div class="right"><h6>Pay attention to flags</h6><div class="flag-explanation"><img src="${asset("images/green_flag_bg.png")}" width="40" alt=""><span><b>Hidden Talent:</b> ${hiddenTalentCopy} Action: Consider trying to build on this strength</span></div><div class="flag-explanation second"><img src="${asset("images/red_flag_bg.png")}" width="40" alt=""><span><b>Blind Spot:</b> ${blindSpotCopy} Action: Identify actions you can take to improve in this area</span></div></div></div></div><div class="container page6">${rows}</div>`, "detail-page");
}

const pct = (value: number, total: number) => `${(value / total * 100).toFixed(4)}%`;
const masterPos = (left: number, top: number, width: number, height: number) => `left:${pct(left, 745)};top:${pct(top, 1053)};width:${pct(width, 745)};height:${pct(height, 1053)}`;
const masterPage = (background: string, overlays = "") => `<section class="legacy-page legacy-master"><img class="legacy-master-bg" src="${background}" alt="">${overlays}</section>`;

function legacyMasterCover(input: TemplateInput) {
  return masterPage(legacyReportBackgrounds.page1, `<div class="master-cover-values"><div class="master-candidate">${esc(input.candidateName)}</div><div class="master-date">${esc(input.reportDate)}</div></div>`);
}

function legacyMasterSummary(input: TemplateInput) {
  const work = input.report.professional.pillarScores;
  const highest = [...work].sort((a, b) => scoreMean(b) - scoreMean(a))[0];
  const lowest = [...work].sort((a, b) => scoreMean(a) - scoreMean(b))[0];
  const gaps = input.categories
    .map((category) => ({ category, gap: scoreMean(categoryScore(input.report, category.id, "professional")) - scoreMean(categoryScore(input.report, category.id, "self")) }))
    .sort((a, b) => b.gap - a.gap);
  const items: { category: ReportCategory | undefined; kind: "top" | "low" | "hidden" | "blind"; x: number; y: number }[] = [
    { category: highest ? input.categories.find((category) => category.id === highest.id) : undefined, kind: "top", x: 99, y: 273 },
    { category: lowest ? input.categories.find((category) => category.id === lowest.id) : undefined, kind: "low", x: 391, y: 273 },
    { category: gaps[0]?.category, kind: "hidden", x: 99, y: 672 },
    { category: gaps.at(-1)?.category, kind: "blind", x: 391, y: 672 },
  ];
  const overlays = items.map(({ category, kind, x, y }) => {
    const description = esc(category?.description ?? "");
    const name = esc(category?.name ?? "Not Assigned");
    const narrative = esc(category ? commentFor(input, category, kind) : "");
    return `<div class="master-summary-description" style="${masterPos(x + 78, y, 174, 82)}">${description}</div><div class="master-summary-name" style="${masterPos(x, y + 115, 254, 23)}">${name}</div><div class="master-summary-copy" style="${masterPos(x, y + 138, 254, 164)}">${narrative}</div>`;
  }).join("");
  return masterPage(legacyReportBackgrounds.page4, overlays);
}

function masterBar(score: number, tone: "self" | "org") {
  return `<div class="master-bar ${tone}">${graphSegments(score)}</div>`;
}

function legacyMasterScores(input: TemplateInput) {
  const workPillars = comparisonPillarScores(input);
  const highestId = [...workPillars].sort((a, b) => scoreMean(b) - scoreMean(a))[0]?.id;
  const lowestId = [...workPillars].sort((a, b) => scoreMean(a) - scoreMean(b))[0]?.id;
  const rowTops = [258, 376, 493, 610, 727];
  const rows = input.categories.map((category, index) => {
    const self = categoryScore(input.report, category.id, "self");
    const org = comparisonCategoryScore(input, category.id);
    const selfPercent = scorePercent(self);
    const orgPercent = scorePercent(org);
    const gapPoints = scoreMean(org) - scoreMean(self);
    const gapPercent = orgPercent - selfPercent;
    const icons = `${gapPoints >= 2 ? `<img src="${asset("images/green_flag_bg.png")}" alt="Hidden talent">` : gapPoints <= -2 ? `<img src="${asset("images/red_flag_bg.png")}" alt="Blind spot">` : ""}${category.id === highestId ? `<img src="${asset("images/mountain-small.png")}" alt="Top scoring category">` : ""}${category.id === lowestId ? `<img src="${asset("images/yield-small.png")}" alt="Lowest scoring category">` : ""}`;
    const top = rowTops[index] ?? rowTops.at(-1) ?? 727;
    return `<div class="master-score-row" style="${masterPos(133, top, 455, 76)}"><span class="master-your-label">YOUR SCORE</span>${masterBar(selfPercent, "self")}<div class="master-score-box master-self-value">${selfPercent}%</div>${masterBar(orgPercent, "org")}<div class="master-score-box master-org-value">${orgPercent}%</div><div class="master-gap"><b>GAP</b> ${gapPercent}%</div><div class="master-score-icons">${icons}</div><span class="master-org-label">${usesRaterFeedback(input) ? "INVITED RESPONDENTS SCORE" : "ORGINSIGHTS SCORE"}</span></div>`;
  }).join("");
  const workCaps = [...comparisonCapabilityScores(input)].sort((a, b) => scoreMean(b) - scoreMean(a));
  const top = workCaps.slice(0, 3);
  const bottom = [...workCaps].sort((a, b) => scoreMean(a) - scoreMean(b)).slice(0, 3);
  const gauges = (scores: ReportScore[], tone: "top" | "bottom", x: number) => scores.map((score, index) => {
    const image = tone === "top" ? topPercentGauges[gaugeKey(score)] ?? "" : bottomPercentGauges[gaugeKey(score)] ?? "";
    return `<div class="master-gauge" style="${masterPos(x + index * 91, 923, 82, 83)}"><img src="${image}" alt="${scorePercent(score)} percent"><div>${esc(score.name)}</div></div>`;
  }).join("");
  return masterPage(legacyReportBackgrounds.page5, `${rows}<div class="master-gauge-blank" style="${masterPos(64, 918, 618, 92)}"></div>${gauges(top, "top", 70)}${gauges(bottom, "bottom", 389)}`);
}

function legacyMasterConclusion(input: TemplateInput) {
  return masterPage(legacyReportBackgrounds.page6, `<div class="master-greeting" style="${masterPos(89, 216, 240, 22)}">Hi ${esc(input.candidateName)},</div>`);
}

function legacyMasterStandard(input: TemplateInput) {
  return [
    legacyMasterCover(input),
    masterPage(legacyReportBackgrounds.page2),
    masterPage(legacyReportBackgrounds.page3),
    legacyMasterSummary(input),
    legacyMasterScores(input),
    legacyMasterConclusion(input),
    masterPage(legacyReportBackgrounds.page7, legacyFooter),
  ].join("");
}

const conclusionCopy = `<p> Thank you for taking the time to complete our assessment and congratulations on taking a step towards better understanding yourself and learning what you need to do to get ahead in life and your career. Below, we have some advice on how to better leverage your Behavioural strengths as well as how to work on improving your development opportunities.</p><p><b>Behavioural strengths: (top scoring &amp; hidden talent)</b><br>The goal of this assessment is to help you gain a better sense of self-awareness which is known to be strongly linked to better job performance. As a next step, take some time to reflect on your results. You may discover that you are likely to perform well in tasks and responsibilities that tap into your strengths. You can also think about your natural strengths from a motivational perspective. You are likely to be more motivated to perform activities that you prefer, and your strengths are also likely to determine the environments that you enjoy. It’s thus important to play to your strengths and figure out the type of work that you are naturally more inclined to excel in and enjoy doing, which would also lead to high level of job satisfaction in addition to superior performance.</p><p>For each strength that you are now aware of, try to be as objective as you can when looking at the relationship between your performance and your strengths. We highly suggest that you build on the strengths identified in this assessment by thinking about what you can start or continue doing in order to further leverage your natural abilities. Also keep in mind that as you reflect on these strengths, be aware of when you might be relying too heavily on a certain strength that may lead to unbalanced results.</p><p><b>Development opportunities: (lowest scoring &amp; blind spots)</b><br>As a result of this report, you are now also aware of potential developmental opportunities. These are behaviours that may not play to your intrinsic inclinations but are still important for the high performance. The results of your assessment indicate that these behaviours may not come naturally to you when compared to that of your strengths as discussed above. Thus, activities that require these behaviours may not feel engaging or rewarding to you, and you may be less motivated to perform these activities and they may also take longer to do while requiring more efforts from you.</p><p>The next step to take in order to improve on your development areas would be to work in conjunction with your manager/mentor/coach/create an action plan for the behavioural changes that would be the most beneficial for you to work on in order to see the greatest change in your performance. We suggest following the SMART goal setting technique so that your goals are specific, measurable, attainable, realistic, and time bound. The reason why we recommend doing this with someone else is so that they can keep you accountable and give you guidance and feedback as you embark on the journey to make these changes.</p>`;
// Legacy source trace: pdfpage.php Conclusion. The signature asset is the recovered
// Akeel Mohamed signature supplied with the original template asset set.
function conclusionPage(input: TemplateInput, final: boolean) { return page(`${pageLogo()}${pageHeader("CONCLUSION", "", "", "page7-header")}<div class="clear-fix"></div><div class="container page7-container"><p>Hi ${esc(input.candidateName)},</p>${conclusionCopy}<div class="sig"><img src="${asset("images/AkeelMohamed-signature.png")}" alt="" width="120"><div>Akeel Mohamed<br>Director, OrgInsights</div></div></div>`, "conclusion-page", final); }
// Legacy source trace: lastpage.php, used only by the standard/non-full report conditional.
// Legacy source trace: css/main.css is embedded byte-for-byte first; the following rules
// only recreate print pagination and the PHP template's own inline overrides in Chromium.
function reportCss() {
  return `@font-face{font-family:Roboto;src:url('${reportFonts.robotoRegular}')}@font-face{font-family:Roboto;src:url('${reportFonts.robotoBold}');font-weight:700}@font-face{font-family:Montserrat;src:url('${reportFonts.montserratRegular}')}@font-face{font-family:Montserrat;src:url('${reportFonts.montserratMedium}');font-weight:500}@font-face{font-family:Montserrat;src:url('${reportFonts.montserratBold}');font-weight:700}${legacyReportCss.replace("../images/page_title_bg.png", asset("images/page_title_bg.png"))}@page{size:A4;margin:0}body{counter-reset:reportPage}.legacy-page{position:relative;width:210mm;height:297mm;overflow:hidden;page-break-after:always;background:#fff;counter-increment:reportPage}.legacy-page:last-child{page-break-after:auto}.legacy-page:not(:first-child)::after{content:counter(reportPage);position:absolute;right:18mm;bottom:7mm;z-index:50;display:grid;place-items:center;box-sizing:border-box;width:7mm;height:7mm;border-radius:50%;background:rgba(255,255,255,.92);color:#315468;font:700 9pt/1 Roboto,Arial,sans-serif}.legacy-page:last-child::after{right:12mm;bottom:5mm;background:transparent}.footer{box-sizing:border-box!important;left:0!important;right:0!important;bottom:0!important;width:100%!important;height:18mm!important;padding:7mm 24mm!important;text-align:center!important;overflow:visible!important}.footer p{box-sizing:border-box;width:100%!important;margin:0!important;text-align:center!important;white-space:nowrap;font-size:10pt!important;line-height:4mm!important}.about-list{padding-top:0}.legacy-spacers{height:54px;overflow:hidden;color:#fff;font-size:8px;line-height:8px}.legacy-spacers p{margin:0}.about-list li{margin-bottom:18px!important}.report-summary-wrapper{left:0;right:0}.ideal-score-section{position:absolute;bottom:18mm;left:0;right:0;max-width:640px;margin:0 auto;text-align:center}
.ideal-score-section h4{font-size:20px;font-weight:800;color:#111;margin:0 0 2px}
.ideal-score-sub{font-size:12px;color:#444;margin:0 0 12px}
.ideal-score-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:10px}
.ideal-score-box{border:1px solid #d0d8d4;border-radius:8px;overflow:hidden;background:#fff}
.ideal-score-label{background:#1a3a5c;color:#fff;font-size:9px;font-weight:700;padding:8px 4px;line-height:1.3;min-height:32px;display:flex;align-items:center;justify-content:center}
.ideal-score-body{padding:10px 4px}
.ideal-score-avg{display:block;font-size:9px;color:#555}
.ideal-score-pct{display:block;font-size:22px;font-weight:800;color:#16814a;margin:2px 0}
.ideal-score-range{display:block;font-size:9px;color:#333}
.ideal-score{position:absolute;bottom:16px;left:0;right:0;text-align:center;color:#111}.ideal-score>b{display:block;font-size:12px}.ideal-score>span{display:block;font-size:9px}.ideal-score>div{display:flex;justify-content:center;gap:10px;margin-top:5px}.ideal-score i{display:inline-grid;place-items:center;width:36px;height:26px;background:#d6eadb;color:#16814a;border:2px solid #16814a;border-radius:4px;font-size:10px;font-style:normal;font-weight:700}.model-page .capb-model{margin-top:5px!important;padding-top:5px}.model-page .list-item{margin-top:3px!important}.summary-page .summary-boxes{margin-top:10px}.summary-page .summary-box{height:370px!important}.summary-page .icon-text{height:100px!important}.radius-box2{height:165px!important}.high-level-page .page-header{margin-bottom:0}.legacy-top-box{text-align:center;height:26px;overflow:hidden}.legacy-top-box img{width:350px}.legend-strip{display:none}.legend-strip table{width:100%}.legend-strip img{width:28px}.high-level-page .score-graph{padding-top:4px}.high-level-page .score-graph .right-section{height:87px}.high-level-page .chart-bottom{padding-top:10px}.gauge-grid{display:flex}.gauge-item{width:33%;text-align:center}.gauge-item img{width:50px!important;height:51px;object-fit:contain;margin:8px auto 0!important}.gauge-item h6{font-size:9px;line-height:10px;padding:0 4px}.detail-page .creating-purpose{margin-top:15px}.detail-page .creating-purpose-wrapper{height:185px}.detail-page .page6.container{margin-top:0}.detail-page .page6-score-graph{padding-top:13px}.detail-page .page6-score-graph .right-section{height:85px}.detail-page .creating-purpose .middle{padding-top:35px}.page7-header{margin-bottom:20px}.upgrade-legacy{padding:15px 20px 0}.upgrade-legacy table{width:100%;height:180px}.upgrade-title-left{padding-left:10px;font-size:16px;border-left:5px solid green}.upgrade-title-right{padding-right:10px;font-size:16px;border-right:5px solid green}.upgrade-copy{font-size:12px;line-height:15px;margin-top:20px}.upgrade-how-title{background:#013359;color:#fff;text-align:center;padding:8px;font-size:16px;font-weight:700}.upgrade-how{background:#004173;color:#fff;padding:12px 20px 20px}.upgrade-how table{width:100%}.upgrade-how td{width:33%;padding:0 8px;vertical-align:top}.upgrade-how img{width:150px}.upgrade-how p{font-size:15px;line-height:16px;margin-top:8px}.score-graph .graph-wrapper.graph-wrapper-1 .progress{background-color:#3397DF}.score-graph .graph-wrapper.graph-wrapper-2 .progress{background-color:#1D9A40}img{border:0;outline:0}
/* Chromium print fidelity corrections. The recovered stylesheet was authored for
   dompdf's float model; these scoped rules preserve the original composition
   while giving every section deterministic, non-overlapping geometry. */
.page-header{box-sizing:border-box;background-image:url('${asset("images/page_title_bg.png")}')!important;background-color:transparent!important;background-repeat:no-repeat;background-size:100% 650%;background-position:center;overflow:visible;height:auto;min-height:108px;padding:14px 50px 26px}
.page-header p{line-height:16px;max-width:690px;margin:10px auto 0;white-space:normal}
.about-page .about-list{padding-top:34px}
.about-page .legacy-spacers{display:none}
.about-page .about-list ul{display:flex;flex-direction:column;gap:18px}
.rater-about-page .about-list{padding-top:18px}.rater-counts{display:flex;justify-content:center;gap:24px;width:100%;margin:0 auto 16px}.rater-counts>div{box-sizing:border-box;width:190px;height:78px;padding:13px 10px;text-align:center;color:#fff;background:#135782}.rater-counts>div+div{background:#07b051}.rater-counts strong,.rater-counts span{display:block}.rater-counts strong{font-size:22px;line-height:24px}.rater-counts span{margin-top:7px;font-size:12px;font-weight:700}.rater-about-page .about-list ul{gap:10px}.rater-about-page .about-list li{min-height:34px}.rater-about-page .report-summary{height:430px}.rater-about-page .report-summary ul{gap:7px}.rater-about-page .report-summary li{font-size:10px;line-height:13px}
.about-page .about-list li{display:grid;grid-template-columns:26px 1fr;align-items:start;margin:0!important;line-height:18px;min-height:42px}
.about-page .about-list li .icon-wrapper{width:26px}
.about-page .about-list li .text{padding-left:10px;line-height:18px}
.about-page .report-summary-wrapper{position:absolute;bottom:0;width:100%}
.about-page .report-summary{height:420px}
.about-page .report-summary ul{display:flex;flex-direction:column;gap:13px}
.about-page .report-summary li{display:grid;grid-template-columns:30px 1fr;line-height:15px;margin:0!important}
.about-page .report-summary li .text{padding-left:8px;line-height:15px}
.model-page{font-family:Roboto,sans-serif}
.model-page .page3-banner{height:160px;object-fit:cover}
.model-page .capb-model{box-sizing:border-box;width:730px;min-height:126px;margin:0 auto!important;padding:10px 0 8px!important;display:grid;grid-template-columns:285px 1fr;column-gap:16px;float:none;border-bottom:2px solid #e6debd;break-inside:avoid}
.model-page .capb-model .left-section,.model-page .capb-model .right-section{width:auto;float:none;padding:0;min-width:0}
.model-page .capb-model .left-section{display:grid;grid-template-columns:58px 1fr;align-items:stretch}
.model-page .capb-model .left-section .letter{box-sizing:border-box;margin:0;background:#c0ab5c;border-radius:8px 0 0 8px;padding:16px 0 0;text-align:center;line-height:48px;font-size:48px;min-height:102px;position:static}
.model-page .capb-model .left-section .details{box-sizing:border-box;margin:0;padding:11px 13px;background:#e6debd;border-radius:0 8px 8px 0;min-height:102px;font-size:9px;line-height:12px;overflow:visible}
.model-page .capb-model .left-section .details h6{font-size:11px;line-height:13px;margin:0 0 5px;white-space:normal}
.model-page .capb-model .left-section .details p{font-size:9px;line-height:12px;overflow-wrap:normal;word-break:normal;hyphens:none}
.model-page .capb-model .right-section{display:flex;flex-direction:column;justify-content:center}
.model-page .capb-model .right-section .list-item{display:grid;grid-template-columns:7px 1fr;column-gap:6px;align-items:start;margin:2px 0!important;font-size:8px;line-height:10px}
.model-page .capb-model .right-section .list-item .icon{width:5px;height:5px;margin-top:2px}
.model-page .capb-model .right-section .list-item p{box-sizing:border-box;width:auto;display:block;padding:0;font-size:8px;line-height:10px;overflow-wrap:normal;word-break:normal;hyphens:none}
.model-page .capb-model .right-section .separator{display:none}
.model-page>.clear-fix{display:none}
.summary-page .summary-box .radius-box{line-height:14px;font-size:10px;overflow:hidden}
.high-level-page .page-header{margin-bottom:0}
.high-level-page .legacy-top-box{height:34px;padding-top:3px}
.high-level-page .score-graph{box-sizing:border-box;padding-top:3px;height:98px;display:grid;grid-template-columns:50px 1fr}
.high-level-page .score-graph .letter{float:none;width:50px;height:92px;font-size:54px;line-height:70px}
.high-level-page .score-graph .right-section{box-sizing:border-box;float:none;width:auto;height:96px;padding-top:3px}
.high-level-page .score-graph .score-label{display:block;position:relative;z-index:3;height:12px;line-height:12px}
.high-level-page .score-graph .middle-wrapper{box-sizing:border-box;display:flex;align-items:flex-start;height:50px;padding-top:0;overflow:visible}
.high-level-page .score-graph .middle-wrapper>div{display:block;flex:0 0 auto}
.high-level-page .score-graph .main-graphs{width:250px}
.high-level-page .score-graph .graph-wrapper .graph-box{position:relative;z-index:2;background:transparent;border-color:#fff}
.high-level-page .score-graph .graph-wrapper.graph-wrapper-1 .progress{background-color:#DBCD91!important}
.high-level-page .score-graph .graph-wrapper.graph-wrapper-2 .progress{background-color:#B8AB79!important}
.high-level-page .score-graph .graph-rating{width:48px}
.high-level-page .score-graph .graph-rating>div{box-sizing:border-box;height:24px;padding:3px 5px;text-align:center}
.high-level-page .score-graph .gap{box-sizing:border-box;width:82px;height:48px;padding:0 5px;text-align:center;line-height:46px;white-space:nowrap}
.high-level-page .score-graph .icon{box-sizing:border-box;width:108px;height:48px;padding:0 4px;display:flex!important;align-items:center;gap:4px;overflow:visible}
.high-level-page .score-graph .icon img{width:38px;height:38px;object-fit:contain;margin:0}
.high-level-page .chart-bottom{box-sizing:border-box;clear:both;width:690px;height:240px;margin:4px auto 0;padding:10px 0 0;display:grid;grid-template-columns:1fr 1fr}
.high-level-page .chart-bottom>div{box-sizing:border-box;float:none;width:auto!important;min-width:0}
.high-level-page .chart-bottom .left{padding-right:22px;border-right:1px solid #ddd}
.high-level-page .chart-bottom .right{padding:0 0 0 30px}
.high-level-page .chart-bottom h5{font-size:15px;line-height:18px;padding-bottom:5px}
.high-level-page .chart-bottom p{font-size:11px;line-height:14px;min-height:32px}
.high-level-page .gauge-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:7px;margin-top:7px;align-items:start}
.high-level-page .gauge-item{width:auto;min-width:0;text-align:center}
.high-level-page .gauge-item img{display:block;width:64px!important;height:66px!important;object-fit:contain;margin:0 auto 6px!important}
.high-level-page .gauge-item h6{font-size:9px;line-height:11px;padding:0 2px;overflow-wrap:normal;word-break:normal}
.upgrade-page .page-header{min-height:124px;padding-top:18px;margin-bottom:16px}
.upgrade-page .page-header .main-headline{font-size:24px!important;line-height:25px!important;margin:0 0 8px}
.upgrade-page .page-header p{font-size:12px!important;line-height:15px!important;margin-top:5px}
.upgrade-page .upgrade-legacy{padding:8px 20px 0}
.upgrade-page .upgrade-legacy table{height:165px;border-collapse:collapse}
.upgrade-page .upgrade-copy{font-size:11px;line-height:14px;margin-top:14px}
.upgrade-page .upgrade-how-title{box-sizing:border-box;height:34px;padding:8px;margin:2px 0 0}
.upgrade-page .upgrade-how{box-sizing:border-box;height:230px;padding:14px 18px 12px}
.upgrade-page .upgrade-how table{table-layout:fixed;border-collapse:collapse}
.upgrade-page .upgrade-how td{box-sizing:border-box;width:33.333%;padding:0 11px;vertical-align:top}
.upgrade-page .upgrade-how img{display:block;width:150px;height:auto;margin:0 auto}
.upgrade-page .upgrade-how p{font-size:14px;line-height:15px;margin:9px 0 0;color:#fff}
.upgrade-page .footer{box-sizing:border-box;left:0;right:0;bottom:0;width:100%;height:18mm;padding:7mm 24mm;text-align:center;overflow:visible}
.upgrade-page .footer p{box-sizing:border-box;width:100%;margin:0;text-align:center;white-space:nowrap;font-size:10pt;line-height:4mm}
/* Detailed-breakdown pages use explicit grid geometry rather than the legacy
   inline-block and float model. This keeps both score rows, labels, values,
   gap and flag aligned in Chromium's PDF renderer. */
.detail-page .page6-header{box-sizing:border-box;min-height:150px;padding:34px 50px 24px;margin:0}
.detail-page .page6-header .page6-headline{margin:0 0 10px;font-size:28px;line-height:32px}
.detail-page .page6-header p{max-width:690px;margin:0 auto;font-size:13px;line-height:17px}
.detail-page .creating-purpose-wrapper{box-sizing:border-box;height:245px;padding-top:48px}
.detail-page .creating-purpose{box-sizing:border-box;display:grid;grid-template-columns:160px 238px 252px;width:650px;height:196px;margin:0 auto;border:1px solid #d8d8d8;border-radius:10px;overflow:hidden}
.detail-page .creating-purpose>div{display:block;box-sizing:border-box;min-width:0}
.detail-page .creating-purpose .left{width:auto;padding:10px 20px 12px;display:flex;flex-direction:column;align-items:flex-start;justify-content:center}
.detail-page .creating-purpose .left img{display:block;width:100px;height:100px;object-fit:contain;margin:0}
.detail-page .creating-purpose .left span{display:block;margin-top:12px;font-size:13px;line-height:16px;white-space:nowrap}
.detail-page .creating-purpose .middle{width:auto;padding:41px 18px 12px}
.detail-page .creating-purpose .middle .title{font-size:17px;line-height:19px;margin:0 0 10px}
.detail-page .creating-purpose .middle p{font-size:11px;line-height:15px;margin:0;overflow-wrap:normal;word-break:normal;hyphens:none}
.detail-page .creating-purpose .right{float:none;width:auto;height:100%;padding:11px 18px 8px;background:#f3f8fb}
.detail-page .creating-purpose .right h6{font-size:14px;line-height:18px;margin:0 0 12px;font-weight:400}
.detail-page .creating-purpose .right .flag-explanation{display:grid;grid-template-columns:42px 1fr;column-gap:7px;align-items:start;margin:0 0 12px;font-size:9px;line-height:12px}
.detail-page .creating-purpose .right .flag-explanation.second{margin:0}
.detail-page .creating-purpose .right .flag-explanation img{display:block;width:40px;height:40px;object-fit:contain;margin:0}
.detail-page .creating-purpose .right .flag-explanation span{display:block;box-sizing:border-box;padding:0;font-size:9px;line-height:12px;overflow:visible;overflow-wrap:normal;word-break:normal;hyphens:none}
.detail-page .creating-purpose .right .flag-explanation b{font-weight:500}
.detail-page .page6.container{box-sizing:border-box;width:600px;margin:22px auto 0}
.detail-page .page6-score-graph{box-sizing:border-box;display:grid;grid-template-columns:50px 1fr;width:100%;height:124px;padding:0;clear:both}
.detail-page .page6-score-graph .round-wrapper{float:none;width:50px;padding-top:9px}
.detail-page .page6-score-graph .round{box-sizing:border-box;width:35px;height:35px;border:3px solid #ddd;border-radius:50%;font-size:20px;line-height:29px;text-align:center;color:#ddd}
.detail-page .page6-score-graph .right-section{position:relative;float:none;box-sizing:border-box;width:auto;height:102px;padding:0}
.detail-page .page6-score-graph .right-section>.title{position:absolute;left:0;top:0;width:100%;font-size:20px;line-height:24px;font-weight:700;white-space:normal}
.detail-page .page6-score-graph .score-label{position:absolute;left:0;z-index:3;display:block;height:10px;font-size:8px;line-height:10px;color:#111;white-space:nowrap}
.detail-page .page6-score-graph .self-score-label{top:25px}
.detail-page .page6-score-graph .org-score-label{top:85px}
.detail-page .page6-score-graph .middle-wrapper{position:absolute;left:0;top:35px;box-sizing:border-box;display:grid;grid-template-columns:250px 49px 90px 76px;align-items:start;width:465px;height:50px;padding:0;overflow:visible}
.detail-page .page6-score-graph .middle-wrapper>div{display:block;box-sizing:border-box;margin:0;padding:0}
.detail-page .page6-score-graph .main-graphs{width:250px;height:50px}
.detail-page .page6-score-graph .graph-wrapper{box-sizing:border-box;position:relative;width:250px;height:25px;padding:0;background:#ddd;overflow:hidden}
.detail-page .page6-score-graph .graph-wrapper .progress{position:absolute;left:0;top:0;height:25px;margin:0;border:0;z-index:0}
.detail-page .page6-score-graph .graph-wrapper .graph-box{position:relative;z-index:2;box-sizing:border-box;display:inline-block;width:50px;height:25px;margin:0 -4px 0 0;border:1px solid #fff;background:transparent}
.detail-page .page6-score-graph .graph-wrapper .graph-box.first{margin-left:0}
.detail-page .page6-score-graph .graph-rating{width:49px;height:50px}
.detail-page .page6-score-graph .graph-rating>div{box-sizing:border-box;width:49px;height:25px;margin:0;border:1px solid #b5b3b3;padding:0;text-align:center;font-size:12px;line-height:23px;background:#fff}
.detail-page .page6-score-graph .graph-rating>.rate-1{margin:0}
.detail-page .page6-score-graph .gap{box-sizing:border-box;width:90px;height:50px;border:1px solid #b5b3b3;border-radius:2px;padding:0;text-align:center;font-size:15px;line-height:48px;white-space:nowrap;background:#fff}
.detail-page .page6-score-graph .icon{box-sizing:border-box;width:76px;height:50px;padding:0 0 0 28px;display:flex!important;align-items:center;justify-content:flex-start}
.detail-page .page6-score-graph .icon img{display:block;width:28px;height:40px;object-fit:contain;margin:0}
.detail-page>.clear-fix,.detail-page .page6-score-graph+.clear-fix{display:none}
/* The colour layer uses the exact score width, while five equal transparent cells
   overlay four single-pixel dividers. This preserves partial segments without a
   sixth sliver or doubled borders in Chromium's PDF renderer. */
.score-graph .graph-wrapper{box-sizing:border-box;position:relative;display:grid!important;grid-template-columns:repeat(5,minmax(0,1fr));column-gap:0;width:250px;height:25px;padding:0;background:#ddd!important;overflow:hidden}
.score-graph .graph-wrapper .progress{position:absolute;left:0;top:0;height:25px;margin:0!important;border:0!important;z-index:1}
.score-graph .graph-wrapper .graph-box{position:relative;z-index:2;box-sizing:border-box;display:block;width:auto!important;height:25px;margin:0!important;border:0!important;background:transparent!important}
.score-graph .graph-wrapper .graph-box+.graph-box{border-left:1px solid #fff!important}
.score-graph .graph-wrapper.graph-wrapper-1 .progress{background:#3397DF!important}
.score-graph .graph-wrapper.graph-wrapper-2 .progress{background:#1D9A40!important}
.high-level-page .score-graph .graph-wrapper.graph-wrapper-1 .progress{background:#DBCD91!important}
.high-level-page .score-graph .graph-wrapper.graph-wrapper-2 .progress{background:#B8AB79!important}
.legacy-master{font-family:Roboto,Arial,sans-serif}.legacy-master-bg{position:absolute;inset:0;width:100%;height:100%;display:block;object-fit:fill}.master-cover-values{position:absolute;left:0;right:0;top:75.45%;height:9.6%;background:#fff;text-align:center;color:#000}.master-candidate{font-family:Montserrat,Arial,sans-serif;font-size:30px;line-height:38px;padding-top:7px}.master-date{font-family:Montserrat,Arial,sans-serif;font-size:17px;line-height:24px}.master-summary-description,.master-summary-name,.master-summary-copy{position:absolute;box-sizing:border-box;overflow:hidden;color:#000}.master-summary-description{background:#fff;font-size:9.2px;line-height:13px;padding:0 3px}.master-summary-name{background:#dfce8d;border-radius:8px 8px 0 0;font-size:15px;line-height:23px;padding:0 10px;white-space:nowrap}.master-summary-copy{background:#edf2f7;font-size:9.3px;line-height:14px;padding:11px 10px 5px;border-radius:0 0 8px 8px}.master-score-row{position:absolute;box-sizing:border-box;background:#fff;color:#000;font-family:Roboto,Arial,sans-serif}.master-your-label,.master-org-label{position:absolute;left:4px;font-size:9px;line-height:11px;color:#000}.master-your-label{top:0}.master-org-label{top:62px}.master-bar{position:absolute;left:4px;display:grid;grid-template-columns:repeat(5,minmax(0,1fr));column-gap:0;width:237px;height:23px;background:#ddd;overflow:hidden}.master-bar.self{top:12px}.master-bar.org{top:36px}.master-bar .progress{position:absolute;left:0;top:0;height:23px;z-index:1}.master-bar.self .progress{background:#dbcd91}.master-bar.org .progress{background:#b8ab79}.master-bar .graph-box{position:relative;z-index:2;box-sizing:border-box;height:23px;background:transparent}.master-bar .graph-box+.graph-box{border-left:1px solid #fff}.master-score-box{position:absolute;left:244px;width:45px;height:23px;box-sizing:border-box;border:1px solid #ddd;background:#fff;text-align:center;font-size:12px;line-height:21px}.master-self-value{top:12px}.master-org-value{top:36px}.master-gap{position:absolute;left:294px;top:12px;width:84px;height:47px;box-sizing:border-box;border:1px solid #ddd;background:#fff;text-align:center;font-size:13px;line-height:45px;white-space:nowrap}.master-gap b{font-weight:700}.master-score-icons{position:absolute;left:393px;top:12px;width:58px;height:48px;display:flex;align-items:center;gap:2px;background:#fff}.master-score-icons img{display:block;width:29px;height:40px;object-fit:contain}.master-gauge-blank{position:absolute;background:#fff}.master-gauge{position:absolute;box-sizing:border-box;background:#fff;text-align:center;color:#000;font-family:Roboto,Arial,sans-serif;overflow:hidden}.master-gauge img{display:block;width:50px;height:51px;object-fit:contain;margin:0 auto 3px}.master-gauge div{font-size:8px;line-height:9px;padding:0 2px}.master-greeting{position:absolute;box-sizing:border-box;background:#fff;color:#000;font-family:Roboto,Arial,sans-serif;font-size:12px;line-height:22px;padding-left:2px;white-space:nowrap}
@media print{body{print-color-adjust:exact;-webkit-print-color-adjust:exact}}`;
}
export function renderOriginalReportHtml(input: TemplateInput): string {
  const pages = input.detailed ? (() => {
    const detailedPages = [coverPage(input), aboutPage(input), masterPage(legacyReportBackgrounds.page3), summaryPage(input), legacyMasterScores(input)];
    for (const category of input.categories) detailedPages.push(detailPage(input, category));
    detailedPages.push(conclusionPage(input, true));
    return detailedPages.join("");
  })() : legacyMasterStandard(input);
  return `<!doctype html><html lang="en"><head><meta charset="utf-8"><title>Orginsights PDF</title><style>${reportCss()}</style></head><body>${pages}</body></html>`;
}
