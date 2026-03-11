function sortTable(columnIndex) {
  const tableBody = document.getElementById("student-table-body");
  const rows = Array.from(tableBody.querySelectorAll("tr"));
  let ascending = true;

  // Toggle sorting direction
  if (tableBody.dataset.sortIndex == columnIndex) {
    ascending = tableBody.dataset.sortOrder === "asc" ? false : true;
  }

  // Update sort state
  tableBody.dataset.sortIndex = columnIndex;
  tableBody.dataset.sortOrder = ascending ? "asc" : "desc";

  // Sort rows
  rows.sort((a, b) => {
    const cellA = a.children[columnIndex].innerText.trim();
    const cellB = b.children[columnIndex].innerText.trim();

    if (!isNaN(cellA) && !isNaN(cellB)) {
      return ascending ? cellA - cellB : cellB - cellA; // Numerical sort
    }

    return ascending ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA); // Lexical sort
  });

  // Reinsert sorted rows
  rows.forEach((row) => tableBody.appendChild(row));
}
