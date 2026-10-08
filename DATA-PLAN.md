# Data Plan

## Existing assessment data
- Candidate profiles, assessment answers, raters, report calculations, orders, settings, and audit events are created by the user through the artifact's own actions and stored in the artifact database.
- The assessment catalog and scoring logic remain the existing product data and contract.

## RepCheck public-web data
### Brave Search API, with managed-search fallback
**Used by:** `saveReputationKeys`, `getReputationConfiguration`, `runReputationScan`

RepCheck uses the workspace administrator's server-stored Brave Search plan key when configured. The key is submitted through masked settings fields, verified against Brave before replacement, never returned to the client, and never written into source or build files. The Answers plan key is verified and stored alongside it for provider readiness; classification remains on the artifact's bounded managed inference path. If no Brave Search key is configured, the existing managed public-search channel remains the fallback.

The Brave API request contract was checked against: https://github.com/bdmorin/the-no-shop/blob/HEAD/plugins/brave-search/skills/brave-search/SKILL.md

RepCheck runs only after both assessment sections are complete. It builds two searches from the user's entered public name plus optional city, country, employer or role, public handles, and distinguishing terms. Results are deduplicated by the exact URL returned by the active search channel and capped at fourteen records per scan. No demo findings are inserted.

### Managed bounded inference
**Used by:** `runReputationScan`

A bounded schema classifies each returned title, snippet, and source as a likely, possible, or unlikely identity match; positive, neutral, negative, or unclear tone; broad source category; cautious match reason; and one practical non-legal next step. Candidate content is treated as untrusted evidence, not as instructions. The UI states that negative tone does not verify a claim.

## Long-term behavior
- Scans are manual only. Each scan is timestamped and retained in the current OrgInsights profile's RepCheck history.
- Findings are ordered by user confirmation, match confidence, tone, and original search rank.
- The 0–100 signal uses likely and possible matches, excludes unlikely or user-excluded findings, and recalculates when the user marks “This is me” or “Not me.”
- RepCheck is a self-reputation review using public web results. It is not a criminal background check, credit report, or third-party screening tool.
- Search result URLs are stored exactly as returned by the managed search tool and opened as external links.

## Imagery
No imagery is added. RepCheck is an evidence-review utility where source labels, match controls, remediation guidance, and legibility are the primary visual content.
